<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\CreateSlug;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
class BlogController extends Controller
{
    use CreateSlug;
    public function index()
    {
        $user_id = Auth::id();
        $blogs = Blog::withCount('comments')->where('user_id', $user_id)->orderBy('id', 'desc')->paginate(15);
        return view('users.blog.index')->with(compact('blogs'));
    } 

    public function create(){
        $data['categories'] = Category::where('parent_id', '=', null)->orderBy('name', 'asc')->where('status', 1)->get();
        return view('users.blog.blog')->with($data);
    }

       //store new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'feature_image' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        // Insert post
        $data = new Blog();
        $data->title = $request->title;
        $data->slug = $this->createSlug('blogs', $request->title);
        $data->description = $request->description;
        $data->category_id = $request->category_id;
        $data->user_id = Auth::id();
        $data->publish_date = now();
        $data->keywords = ($request->meta_keywords) ? implode(',', $request->meta_keywords) : null;
        $data->status = 'active';

        //if feature image set
        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $new_image_name = $this->uniqueImagePath('blogs', 'image', $request->title.'.'.$image->getClientOriginalExtension());
            $image_path = public_path('upload/images/blog/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(200, 150);
            $image_resize->save($image_path);
            $image->move(public_path('upload/images/blog'), $new_image_name);
            $data->image = $new_image_name;
        }

        $store = $data->save();

        if($store) {
            
            Toastr::success('Blog Create Successfully.');
        }else{
            Toastr::error('Blog Cannot Create.!');
        }
        return back();
    }

         //edit post
    public function edit($slug)
    {
        $data['blog'] = Blog::where('slug', $slug)->where('user_id', Auth::id())->first();
        $data['categories'] = Category::where('parent_id', '=', null)->orderBy('name', 'asc')->where('status', 1)->get();
        return view('users.blog.blog-edit')->with($data);
    }

    //update new post
    public function update(Request $request, $blog_id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
        ]);

        // update blog
        $data = Blog::where('id', $blog_id)->where('user_id', Auth::id())->first();
        
        if($data){
       
        $data->title = $request->title;
        $data->description = $request->description;
        $data->category_id = $request->category_id;
        $data->keywords = ($request->meta_keywords) ? implode(',', $request->meta_keywords) : null;
       //if feature image set
        if ($request->hasFile('feature_image')) {
            $getimage_path = public_path('upload/images/blog/'.$data->image);
            if(file_exists($getimage_path) && $data->image){
                unlink($getimage_path);
                unlink(public_path('upload/images/blog/thumb/'.$data->image));
            }
            $image = $request->file('feature_image');
            $new_image_name = $this->uniqueImagePath('blogs', 'image', $request->title.'.'.$image->getClientOriginalExtension());
            $image_path = public_path('upload/images/blog/thumb/'.$new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(200, 150);
            $image_resize->save($image_path);
            $image->move(public_path('upload/images/blog'), $new_image_name);
            $data->image = $new_image_name;
        }

        $update = $data->save();

            if($update) {
             
                Toastr::success('Blog update success.');
            }else{
                Toastr::error('Blog update failed.!');
            }
        }else{
            Toastr::error('Blog update failed.!');
        }
        return back();
    }

    // delete blog
    public function delete($id)
    {
        $user_id = Auth::id();
        $blog = Blog::where('id', $id)->where('user_id', $user_id)->first();
        if($blog){
            $image_path = public_path('upload/images/blog/'. $blog->image);
            if(file_exists($image_path) && $blog->image){
                unlink($image_path);
                unlink(public_path('upload/images/blog/thumb/'. $blog->image));
            }

            $blog->delete();

            $output = [
                'status' => true,
                'msg' => 'Blog deleted successful.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Blog cannot delete.'
            ];
        }
        return response()->json($output);
    }



}
