<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use App\Models\ProductFeature;
use App\Models\ProductVariation;
use App\Models\ProductVariationDetails;
use App\Models\Category;
use App\Models\State;
use App\Models\City;
use App\Models\ReportReason;
use App\Models\Brand;
use App\Models\Package;
use App\Models\PackageValue;
use App\Models\PackagePurchase;
use App\Models\PromoteAds;
use App\Models\PredefinedFeature;
use App\Models\SiteSetting;
use App\Traits\CreateSlug;
use Carbon\Carbon;
class PostController extends Controller
{
    use CreateSlug;
    public function index(Request $request, string $status=null){
        $posts = Product::with('get_promotePackage')->where('user_id', Auth::id())->whereNotIn('status', ['not posted'])->orderBy('id', 'desc');
        $data['reasons'] = ReportReason::where('type', 'product-delete')->where('status', 1)->get();

        if($status){
            if($status == 'image-missing'){
                $posts->where('feature_image', null);
            }
            else{
                $posts->where('status', $status);
            }
        }

        if(!$status && $request->status && $request->status != 'all'){
            $posts->where('status', $request->status);
        }
        if($request->title){
            $posts->where('title', 'LIKE', '%'. $request->title .'%');
        }
        $data['posts'] = $posts->paginate(15);

        return view('users.post.index')->with($data);
    }

    public function create(Request $request, string $category=null, string $subcategory=null){
        $user_id = Auth::id();
        $post_id = $this->generatePostId();

        $post = Product::with("get_galleryImages")->where("post_id", $post_id)->where("user_id", $user_id)->first();
        //insert first step
        if($request->isMethod('post') && !$category){
            
            $category = Category::where('id', $request->category)->where('parent_id', '!=', null)->where('status', 1)->first();
            $category_id = ($category) ? $category->parent_id : $request->category;
            $subcategory_id = ($category) ? $request->category : null;
            // Insert or update post
            if(!$post){
                $post = new Product();
                $post->post_id = $post_id;
                $post->user_id = $user_id;
                $post->post_type = $request->post_type;
                $post->status = "not posted";
            }
            
            $post->category_id = $category_id;
            $post->subcategory_id = $subcategory_id;
            $city = City::where("id", $request->location)->first();
            $post->state_id = $city->state_id;
            $post->city_id = $city->id;
            //if feature image set
            if ($request->hasFile('feature_image')) {
                $image = $request->file('feature_image');
                $image_name = $this->uniqueImagePath('products', 'feature_image', $request->title.'.'.$image->getClientOriginalExtension());

                //thumb image Resize
                $img = Image::make($image->getRealPath())->orientate()->resize(200, null, function($constraint){
                    $constraint->aspectRatio();
                })->resizeCanvas(200, 150);
                $img->save(public_path('upload/images/product/thumb/' . $image_name));

                //Resize image
                $img = Image::make($image->getRealPath())->orientate()->resize(670, 475, function($constraint){
                    $constraint->aspectRatio();
                })->resizeCanvas(670, 475, 'center', false, 'fff');

                if(config('siteSetting.watermark')){
                //Add water mark in image
                $watermark = Image::make(public_path('upload/images/logo/'.config('siteSetting.watermark')));
                $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
                $watermarkSize = $img->width() / 2; //half of the image size (2 dele half)
                $resizePercentage = 50;//0% less then an actual image (play with this value)
                $watermarkSize = round(290); //watermark will be $resizePercentage less then the actual width of the image
                $watermark->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                //insert resized watermark to image center aligned
                $img->insert($watermark->opacity(50), 'bottom');
                //watermark end
                }
                //save image
                $img->save(public_path('upload/images/product/' . $image_name));

                $post->feature_image = $image_name;
            }

            $post->save();

            // gallery Image upload
            ProductImage::where("post_id", $post_id)->delete(); //delete old images
            if ($request->hasFile('gallery_image')) {
                $gallery_image = $request->file('gallery_image');
                foreach ($gallery_image as $image) {
                    $new_image_name = $this->uniqueImagePath('product_images', 'image_path',$request->title.'.'.$image->getClientOriginalExtension());

                    //Resize image
                    $img = Image::make($image->getRealPath())->orientate()->resize(670, 475, function($constraint){
                        $constraint->aspectRatio();
                    })->resizeCanvas(670, 475, 'center', false, 'fff');

                    if(config('siteSetting.watermark')){
                    //Add water mark in image
                    $watermark = Image::make(public_path('upload/images/logo/'.config('siteSetting.watermark')));
                    $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
                    $watermarkSize = $img->width() / 2; //half of the image size (2 dele half)
                    $resizePercentage = 50;//0% less then an actual image (play with this value)
                    $watermarkSize = round($img->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
                    // resize watermark width keep height auto
                    $watermark->resize(250, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    //insert resized watermark to image center aligned
                    $img->insert($watermark->opacity(50), 'bottom');
                    //watermark end
                    }
                    //save image
                    $img->save(public_path('upload/images/product/gallery/' . $new_image_name));
                    ProductImage::create([
                        'post_id' => $post_id,
                        'image_path' => $new_image_name,
                        'title' => $new_image_name
                    ]);
                }
            }

            return redirect()->route('post.create', $category->slug);
        }

        //show second step
        if($category && $post){ 
            $data['post'] = $post;
            $category_id = ($post->category_id) ? $post->category_id : 0;
            $subcategory_id = ($post->subcategory_id) ? $post->subcategory_id : 0;
            
            $data['attributes'] = ProductAttribute::with('get_attrValues')->whereIn('category_id', ['all',$category_id,$subcategory_id ])->where('status', 1)->get();
            $data['features'] = PredefinedFeature::whereIn('category_id', ['all',$category_id,$subcategory_id ])->where('status', 1)->get();
            
            $data['brands'] = Brand::orderBy('name', 'asc')->whereIn('category_id', ['all',$category_id, $subcategory_id ])->where('status', 1)->get();
            $data['chilcategories'] = Category::where('parent_id', $subcategory_id)->where('status', 1)->get();
            $data['packageTypes'] = Package::with([
                'get_packageVlues' => function($query) use ($category_id, $subcategory_id){
                    $query->whereIn('category_id', [$category_id,$subcategory_id ])->where('ads', 1)->where('status', 1);},

                'get_purchasePackages' => function($query) use ($category_id, $subcategory_id){
                    $query->whereIn('category_id', [$category_id,$subcategory_id ])->where('remaining_ads', '>=', 1)->where('payment_status', 'paid')->where('user_id',  Auth::id());}
                ])->where('status', 1)->get();

            return view('users.post.ad-post')->with($data);
        }

        $data['regions'] = State::with("get_city")->orderBy('position', 'desc')->where('status', 1)->get();

        $data['categories'] = Category::with('get_subcategory')->where('parent_id', '=', null)->orderBy('position', 'asc')->where('status', 1)->get();
        return view('users.post.ads-category')->with($data);
    }

    //store new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
        ]);
        $user_id = Auth::id();
        $post_id = $this->generatePostId();
        $post = Product::where("post_id", $post_id)->where("user_id", $user_id)->first();
        $post->title = $request->title;
        $post->slug = $this->createSlug('products', $request->title);
        $post->description = $request->description;
        $post->childcategory_id = ($request->childcategory_id) ? $request->childcategory_id : null;
        $post->brand_id = ($request->brand ? $request->brand : null);
        $post->price = ($request->price) ? $request->price : 0;
        $post->negotiable = ($request->negotiable ? 1 : 0);
        $post->sale_type = ($request->sale_type ? $request->sale_type : null);
        $post->contact_name = ($request->contact_name) ? $request->contact_name : null;
        $post->contact_mobile = ($request->contact_mobile) ? json_encode($request->contact_mobile) : null;
        $post->contact_email = ($request->contact_email) ? $request->contact_email : null;
        $post->contact_hidden = ($request->contact_hidden) ? 1 : 0;
        $post->meta_keywords = ($request->meta_keywords) ? implode(',', $request->meta_keywords) : null;
        $post->user_id = $user_id;
        $post->created_by = $user_id;
        //check ads auto active
        $product_active = SiteSetting::where('type', 'product_activation')->where('status', 1)->first();
        $post->status = ($product_active) ? 'pending' : 'active';
        $store = $post->save();

        if($store) {
            //insert variation
            if ($request->attribute) {
                foreach ($request->attribute as $attribute_id => $attr_value) {
                    //insert product variation
                    $variation = new ProductVariation();
                    $variation->post_id = $post->id;
                    $variation->attribute_id = $attribute_id;
                    $variation->attribute_name = $attr_value;
                    $variation->in_display = 1;
                    $variation->save();
                    if(isset($request->attributeValue) && array_key_exists($attribute_id, $request->attributeValue)) {
                        for ($i = 0; $i < count($request->attributeValue[$attribute_id]); $i++) {
                            $quantity = 0;
                            //check weather attribute value set
                            if (array_key_exists($i, $request->attributeValue[$attribute_id]) && $request->attributeValue[$attribute_id][$i]) {

                                $feature_details = new ProductVariationDetails();
                                $feature_details->post_id = $post->id;
                                $feature_details->attribute_id = $attribute_id;
                                $feature_details->variation_id = $variation->id;
                                $feature_details->attributeValue_name = $request->attributeValue[$attribute_id][$i];
                                $feature_details->save();
                            }

                        }
                    }
                }
            }
            //insert additional Feature data
            if ($request->features) {
                try {
                    foreach ($request->features as $feature_id => $feature_name) {
                        if ($request->featureValue[$feature_id]) {
                            $extraFeature = new ProductFeature();
                            $extraFeature->post_id = $post->id;
                            $extraFeature->feature_id = $feature_id;
                            $extraFeature->name = $feature_name;
                            $extraFeature->value = $request->featureValue[$feature_id];
                            $extraFeature->save();
                        }
                    }
                } catch (Exception $exception) {

                }
            }

            Toastr::success('Post create successfully. Your post under review');
            //redirect payment page for payment
            return redirect()->route('ads.promotePackage', [$post->slug])->with('success', 'Post create successfully. Your post under review');
        }else{
            Toastr::error('Post Cannot Create.!');
        }
        return back();
    }

    //store wanted ad post
    public function storeWantedPost(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $category = Category::where('id', $request->category)->where('parent_id', '!=', null)->where('status', 1)->first();
        $category_id = ($category) ? $category->parent_id : $request->category;
        $subcategory_id = ($category) ? $request->category : null;

        $user_id = Auth::id();
        $post_id = $this->uniqueOrderId('products', 'post_id');
        
        $post = new Product();
        $post->post_id = $post_id;  
        $post->user_id = $user_id;
        $post->post_type = $request->post_type;
        $post->title = $request->title;
        $post->slug = $this->createSlug('products', $request->title);
        $post->category_id = $category_id;
        $post->subcategory_id = $subcategory_id;

        $city = City::where("id", $request->location)->first();
        $post->state_id = $city->state_id;
        $post->city_id = $city->id;
        
        $post->description = $request->description;
        $post->price = ($request->price) ? $request->price : 0;
        $post->negotiable = 1;
        $post->contact_name = ($request->contact_name) ? $request->contact_name : null;
        $post->contact_mobile = ($request->contact_mobile) ? json_encode($request->contact_mobile) : null;
        $post->contact_email = ($request->contact_email) ? $request->contact_email : null;
        $post->contact_hidden = ($request->contact_hidden) ? 1 : 0;
        $post->user_id = $user_id;
        $post->created_by = $user_id;
        //check ads auto active
        $product_active = SiteSetting::where('type', 'product_activation')->where('status', 1)->first();
        $post->status = ($product_active) ? 'pending' : 'active';
        
        //if feature image set
        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $image_name = $this->uniqueImagePath('products', 'feature_image', $request->title.'.'.$image->getClientOriginalExtension());

            //thumb image Resize
            $img = Image::make($image->getRealPath())->orientate()->resize(200, null, function($constraint){
                $constraint->aspectRatio();
            })->resizeCanvas(200, 150);
            $img->save(public_path('upload/images/product/thumb/' . $image_name));

            //Resize image
            $img = Image::make($image->getRealPath())->orientate()->resize(670, 475, function($constraint){
                $constraint->aspectRatio();
            })->resizeCanvas(670, 475, 'center', false, 'fff');

            if(config('siteSetting.watermark')){
            //Add water mark in image
            $watermark = Image::make(public_path('upload/images/logo/'.config('siteSetting.watermark')));
            $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
            $watermarkSize = $img->width() / 2; //half of the image size (2 dele half)
            $resizePercentage = 50;//0% less then an actual image (play with this value)
            $watermarkSize = round(290); //watermark will be $resizePercentage less then the actual width of the image
            $watermark->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            //insert resized watermark to image center aligned
            $img->insert($watermark->opacity(50), 'bottom');
            //watermark end
            }
            //save image
            $img->save(public_path('upload/images/product/' . $image_name));

            $post->feature_image = $image_name;
        }

        $store = $post->save();

        if($store) {
            Toastr::success('Post create successfully. Your post under review');
            //redirect post list page
            return redirect()->route('post.list')->with('success', 'Post create successfully. Your post under review');
        }else{
            Toastr::error('Post Cannot Create.!');
        }
        return back();
    }

    //edit product
    public function edit($slug)
    {
        $data['product'] = Product::with('get_galleryImages')->where('slug', $slug)->where('user_id', Auth::id())->first();
        $post_id = $data['product']->id;

        if($data['product']){
            $subcategory_id = 0;
            if($data['product']->category_id) {
                $category_id = $data['product']->category_id;
            }

            $data['subcategory'] = Category::where('id', $data['product']->subcategory_id)->where('status', 1)->first();
            
            if($data['product']->subcategory_id) {
                $subcategory_id = $data['product']->subcategory_id;
            }

            $data['attributes'] = ProductAttribute::with(['get_attrValues.get_productVariant' => function($query) use ($post_id){$query->where('post_id', $post_id);}])->whereIn('category_id', ['all',$category_id,$subcategory_id ])->where('status', 1)->get();

            $data['features'] = PredefinedFeature::with(['featureValue' => function ($query) use ($post_id) {
                $query->where('post_id', $post_id);
            }])->whereIn('category_id', ['all',$category_id, $subcategory_id ])->where('status', 1)->get();
            $data['regions'] = State::orderBy('name', 'asc')->where('status', 1)->get();
            $data['cities'] = City::where('state_id', $data['product']->state_id)->orderBy('name', 'asc')->where('status', 1)->get();
            $data['brands'] = Brand::orderBy('name', 'asc')->whereIn('category_id', ['all',$category_id, $subcategory_id ])->where('status', 1)->get();
            $data['chilcategories'] = Category::where('parent_id', $subcategory_id)->where('status', 1)->get();

             $data['packageTypes'] = Package::with([
                'get_packageVlues' => function($query) use ($category_id, $subcategory_id){
                    $query->whereIn('category_id', [$category_id,$subcategory_id ])->where('ads', 1)->where('status', 1);},

                'get_purchasePackages' => function($query) use ($category_id, $subcategory_id){
                    $query->whereIn('category_id', [$category_id,$subcategory_id ])->where('remaining_ads', '>=', 1)->where('payment_status', 'paid')->where('user_id',  Auth::id());}
                ])->where('status', 1)->get();
            return view('users.post.ad-post-edit')->with($data);
        }

        return view('404');
    }

    //update new post
    public function update(Request $request, int $post_id)
    {
        $request->validate([
            'title' => 'required',
            'state_id' => 'required',
            'price' => 'required',
        ]);
        $user_id = Auth::id();
        $product_active = SiteSetting::where('type', 'product_activation')->where('status', 1)->first();
        
        // update post
        $data = Product::where('id', $post_id)->where('user_id', Auth::id())->first();
        if($data){
            $data->title = $request->title;
            $data->description = $request->description;
            $data->childcategory_id = ($request->childcategory_id ? $request->childcategory_id : null);
            $data->state_id = ($request->state_id ? $request->state_id : 0);
            $data->city_id = ($request->city_id ? $request->city_id : 0);
            $data->brand_id = ($request->brand ? $request->brand : null);
            $data->price = $request->price;
            $data->negotiable = ($request->negotiable ? 1 : 0);
            $data->sale_type = ($request->sale_type ? $request->sale_type : null);
            $data->contact_name = ($request->contact_name) ? $request->contact_name : null;
            $data->contact_mobile = ($request->contact_mobile) ? json_encode($request->contact_mobile) : null;
            $data->contact_email = ($request->contact_email) ? $request->contact_email : null;
            $data->contact_hidden = ($request->contact_hidden) ? 1 : 0;
            $data->meta_keywords = ($request->meta_keywords) ? implode(',', $request->meta_keywords) : null;

            if($product_active){
                $data->status = ($data->status == 'active') ? 'pending' : $data->status ;
            }
            $data->updated_by = Auth::id();


            //if feature image set
            if ($request->hasFile('feature_image')) {
                $getimage_path = public_path('upload/images/product/'. $data->feature_image);
                if(file_exists($getimage_path) && $data->feature_image){
                    unlink($getimage_path);
                    unlink(public_path('upload/images/product/thumb/'. $data->feature_image));
                }

                $image = $request->file('feature_image');
                $new_image_name = $this->uniqueImagePath('products', 'feature_image', $request->title.'.'.$image->getClientOriginalExtension());

                //Resize image
                $img = Image::make($image->getRealPath())->orientate()->resize(200, null, function($constraint){
                    $constraint->aspectRatio();
                })->resizeCanvas(200, 150);
                $img->save(public_path('upload/images/product/thumb/' . $new_image_name));



                //Resize image
                $img = Image::make($image->getRealPath())->orientate()->resize(670, 475, function($constraint){
                    $constraint->aspectRatio();
                })->resizeCanvas(670, 475, 'center', false, 'e7edee');

                if(config('siteSetting.watermark')){
                //Add water mark in image
                $watermark = Image::make(public_path('upload/images/logo/'.config('siteSetting.watermark')));
                $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
                $watermarkSize = $img->width() / 2; //half of the image size (2 dele half)
                $resizePercentage = 50;//0% less then an actual image (play with this value)
                $watermarkSize = round($img->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
                // resize watermark width keep height auto
                $watermark->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                //insert resized watermark to image center aligned
                $img->insert($watermark->opacity(50), 'bottom');
                //watermark end
                }

                //save image
                $img->save(public_path('upload/images/product/' . $new_image_name));


                $data->feature_image = $new_image_name;
            }

            $update = $data->save();

            if($update) {

                //insert variation
                if ($request->attribute) {
                    foreach ($request->attribute as $attribute_id => $attr_value) {
                        //insert product feature name in feature table

                        $variation = ProductVariation::where('attribute_id', $attribute_id)->where('post_id', $post_id)->first();
                        if(!$variation){
                            $variation = new ProductVariation();
                            $variation->post_id = $data->id;
                            $variation->attribute_id = $attribute_id;
                            $variation->attribute_name = $attr_value;
                            $variation->in_display = 1;
                            $variation->save();
                        }
                        if(isset($request->attributeValue) && array_key_exists($attribute_id, $request->attributeValue)) {
                            for ($i = 0; $i < count($request->attributeValue[$attribute_id]); $i++) {

                                //check weather attribute value set
                                if (array_key_exists($i, $request->attributeValue[$attribute_id]) && $request->attributeValue[$attribute_id][$i]) {

                                    //delete unselected variation
                                    ProductVariationDetails::where('variation_id', $variation->id)->where('post_id', $post_id)->whereNotIn('attributeValue_name', $request->attributeValue[$attribute_id])->delete();

                                    //insert or update feature attribute details in ProductVariationDetails table
                                    $feature_details = ProductVariationDetails::where('attributeValue_name', $request->attributeValue[$attribute_id][$i])->where('post_id', $post_id)->first();

                                    if (!$feature_details) {
                                        $feature_details = new ProductVariationDetails();
                                    }

                                    $feature_details->post_id = $data->id;
                                    $feature_details->attribute_id = $attribute_id;
                                    $feature_details->variation_id = $variation->id;
                                    $feature_details->attributeValue_name = $request->attributeValue[$attribute_id][$i];
                                    $feature_details->save();
                                }

                            }
                        }else{
                            //delete all unselected variation
                            ProductVariation::where('attribute_id', $attribute_id)->where('post_id', $post_id)->delete();
                            ProductVariationDetails::where('attribute_id', $attribute_id)->where('post_id', $post_id)->delete();

                        }
                    }
                }

                //insert or update product feature
                if($request->features){
                    try {
                        foreach($request->features as $feature_id => $feature_name) {

                            $extraFeature = ProductFeature::where('post_id', $post_id)->where('feature_id', $feature_id)->first();
                            if(!$extraFeature){
                                $extraFeature = new ProductFeature();
                            }
                            $extraFeature->post_id = $post_id;
                            $extraFeature->feature_id = $feature_id;
                            $extraFeature->name = $feature_name;
                            $extraFeature->value = ($request->featureValue[$feature_id]) ? $request->featureValue[$feature_id] : null;
                            $extraFeature->save();

                        }
                    }catch (Exception $exception){

                    }
                }

                // gallery Image upload
                if ($request->hasFile('gallery_image')) {
                    $gallery_image = $request->file('gallery_image');
                    foreach ($gallery_image as $image_id => $image) {
                        $productImage = ProductImage::where('post_id', $post_id)->where('id', $image_id)->first();

                        if($productImage){
                            //delete image from folder
                            $image_path = public_path('upload/images/product/gallery/'. $productImage->image_path);
                            if(file_exists($image_path) && $productImage->image_path){
                                unlink($image_path);
                            }
                        }else{
                            $productImage = new ProductImage();
                        }

                        $new_image_name = $this->uniqueImagePath('product_images', 'image_path',$request->title.'.'.$image->getClientOriginalExtension());

                        //Resize image
                        $img = Image::make($image->getRealPath())->orientate()->resize(670, 475, function($constraint){
                            $constraint->aspectRatio();
                        })->resizeCanvas(670, 475, 'center', false, 'e7edee');

                        if(config('siteSetting.watermark')){
                        //Add water mark in image
                        $watermark = Image::make(public_path('upload/images/logo/'.config('siteSetting.watermark')));
                        $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
                        $watermarkSize = $img->width() / 2; //half of the image size (2 dele half)
                        $resizePercentage = 50;//0% less then an actual image (play with this value)
                        $watermarkSize = round($img->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
                        // resize watermark width keep height auto
                        $watermark->resize(250, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        //insert resized watermark to image center aligned
                        $img->insert($watermark->opacity(50), 'bottom');
                        //watermark end
                        }
                        //save image
                        $img->save(public_path('upload/images/product/gallery/' . $new_image_name));

                        $productImage->post_id = $data->id;
                        $productImage->image_path = $new_image_name;
                        $productImage->title = $new_image_name;
                        $productImage->save();
                    }
                }

                //ads promote
                $order_id = $this->uniqueOrderId('package_purchases', 'order_id', 'R');
                $category_id = ($data->subcategory_id) ? $data->subcategory_id : $data->category_id;
                //get number of free post limit by category
                $category = Category::where('id', $data->subcategory_id)->first();
                if($request->package && count($request->package)>0){
                    $purchase = null;
                    foreach($request->package as $package){

                        $package_id = $package;

                        //check whether user package purchase or new package
                        if(is_array($request->purchasPackvalue) && array_key_exists($package, $request->purchasPackvalue)){
                            $packageValue_id = $request->purchasPackvalue[$package];

                            $purchasePackage = PackagePurchase::where('id', $packageValue_id)->where('package_id', $package_id)->where('remaining_ads', '>=', 1)->where('payment_status', 'paid')->where('user_id',  $user_id)->first();

                            if($purchasePackage){
                                $start_date = Carbon::now();
                                $end_date = Carbon::now()->addDays($purchasePackage->duration);

                                $promoteAds = new PromoteAds();
                                $promoteAds->category_id = $category_id;
                                $promoteAds->user_id = $user_id;
                                $promoteAds->package_id = $package_id;
                                $promoteAds->order_id = $purchasePackage->order_id;
                                $promoteAds->ads_id = $data->id;
                                $promoteAds->duration = $purchasePackage->duration;
                                $promoteAds->start_date = $start_date;
                                $promoteAds->end_date = $end_date;
                                $promoteAds->status = 1;
                                $promote = $promoteAds->save();

                                //decrement user purchase remaining ads
                                if($promote){
                                $purchasePackage->decrement('remaining_ads');
                                //update status
                                $data->status = ($product_active) ? 'pending' : 'active';
                                $data->ad_type = $request->package;
                                $data->save();
                                }
                            }
                        }else{
                            $packageValue_id = $request->packageValue[$package];
                            //check package value by selected promote package id
                            $packageValue = PackageValue::where('package_id', $package_id)->where('id', $packageValue_id)->whereIn('category_id', [$data->category_id,$data->subcategory_id ])->first();
                            if($packageValue){
                                //purchase new package
                                $purchasePackage = new PackagePurchase();
                                $purchasePackage->order_id = $order_id;
                                $purchasePackage->user_id = $data->user_id;
                                $purchasePackage->category_id = $category_id;
                                $purchasePackage->package_id = $package_id;
                                $purchasePackage->total_ads = $packageValue->ads;
                                $purchasePackage->remaining_ads = $packageValue->ads;
                                $purchasePackage->duration = $packageValue->duration;
                                $purchasePackage->price = $packageValue->price;
                                $purchasePackage->currency = config('siteSetting.currency');
                                $purchasePackage->currency_sign = config('siteSetting.currency_symble');
                                $purchasePackage->payment_method = 'pending';
                                $purchasePackage->purchase_for = $data->id;
                                $purchasePackage->post_fee = ($category && $category->post_fee) ? $category->post_fee : 0 ;
                                $purchase = $purchasePackage->save(); 
                            }
                        }
                    }

                    if($purchase){
                        //redirect payment page for payment
                        return redirect()->route('ads.promotePayment', [$data->slug, $order_id])->with('success', 'Your ads has been successfully post.');
                    }
                }else{
                    if($data->status == 'Not posted' || $data->status == 'draft'){
                        
                        if($category && $category->post_fee > 0){
                            
                        //post fee
                        $purchasePackage = new PackagePurchase();
                        $purchasePackage->order_id = $order_id;
                        $purchasePackage->user_id = $data->user_id;
                        $purchasePackage->category_id = $category_id;
                        $purchasePackage->package_id = 'post_fee';
                        $purchasePackage->total_ads = 0;
                        $purchasePackage->remaining_ads = 0;
                        $purchasePackage->duration = 0;
                        $purchasePackage->price = $category->post_fee;
                        $purchasePackage->currency = config('siteSetting.currency');
                        $purchasePackage->currency_sign = config('siteSetting.currency_symble');
                        $purchasePackage->payment_method = 'pending';
                        $purchasePackage->purchase_for = $data->id;
                        $purchasePackage->post_fee = 0;
                        $purchase = $purchasePackage->save(); 

                        //redirect payment page for payment
                        return redirect()->route('ads.promotePayment', [$data->slug, $order_id])->with('success', 'Your ads has been successfully post.');
                        }
                    }
                   
                }
                Toastr::success('Post update success.');
                return redirect()->route('post.list')->with('success', 'Post update successfully. Your post under review.');
            }else{
                Toastr::error('Post update failed.!');
            }
        }else{
            Toastr::error('Post update failed.!');
        }
        return back();
    }

    // delete product
    public function delete(Request $request)
    {
        $product = Product::where('id',$request->product_id)->where('user_id', Auth::id())->first();
        if($product){

            $gallery_images = ProductImage::where('post_id',  $product->post_id)->get();
            foreach ($gallery_images as $gallery_image) {
                $image_path = public_path('upload/images/product/gallery/'. $gallery_image->image_path);
                if(file_exists($image_path) && $gallery_image->image_path){
                    unlink($image_path);
                }
                
                $gallery_image->delete();
            }

            $output = [
                'status' => true,
                'msg' => 'Post deleted successful.'
            ];

            //force sotf delete
            if($product->approved == null){
                $image_path = public_path('upload/images/product/'. $product->feature_image);
                if(file_exists($image_path) && $product->feature_image){
                    unlink($image_path);
                }
                ProductVariation::where('product_id',  $product->id)->delete();
                ProductVariationDetails::where('product_id',  $product->id)->delete();
                ProductFeature::where('product_id',  $product->id)->delete();

                $product->forceDelete();
            }else{
                //delete reason
                $product->delete_reason = $request->reason .':<br/>'. $request->reason_details;
                $product->save();
                $product->delete();
            }
            Toastr::success('Post deleted successful.');
        }else{
            Toastr::error('Post delete failed.');
        }
        return back();
    }

    // delete product image
    public function productImageDelete($id)
    {
        $product = Product::find($id);
        if($product){
            $image_path = public_path('upload/images/product/'. $product->feature_image);
            if(file_exists($image_path) && $product->feature_image){
                unlink($image_path);
                unlink(public_path('upload/images/product/thumb/'. $product->feature_image));
            }
            $product->delete();
            $output = [
                'status' => true,
                'msg' => 'Product image deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Product image cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    // delete GalleryImage
    public function deleteGalleryImage($id)
    {
        $find = ProductImage::find($id);
        if($find){
            //delete image from folder
            $thumb_image_path = public_path('upload/images/product/gallery/thumb/'. $find->image_path);
            $image_path = public_path('upload/images/product/gallery/'. $find->image_path);
            if(file_exists($image_path) && $find->image_path){
                unlink($image_path);
                unlink($thumb_image_path);
            }
            $find->delete();
            $output = [
                'status' => true,
                'msg' => 'Gallery image deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Gallery image cannot deleted.'
            ];
        }
        return response()->json($output);
    }


    //generate order id
    public function generatePostId()
    {
        $user_id = Auth::id();
        $orderNo = Product::where("user_id", $user_id)->where("post_type", "sell")->where("status", "!=", "not posted")->count() + 1;
        $prefix = $user_id;
        $numberLen = 6 - strlen($prefix.$orderNo);
        $order_id = $prefix.substr(str_shuffle("00000"), - $numberLen).$orderNo;
        return $order_id;
    }



}
