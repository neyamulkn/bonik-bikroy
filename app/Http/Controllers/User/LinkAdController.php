<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Addvertisement;
use App\Models\Page;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
class LinkAdController extends Controller
{

    public function index(Request $request){
        $advertisements = Addvertisement::orderBy('id', 'DESC');
        if($request->title){
            $advertisements->where('ads_name', 'LIKE', '%'. $request->title .'%');
        }
        if($request->adsType && $request->adsType != 'all'){
            $advertisements->where('adsType', $request->adsType);
        }if($request->page_name && $request->page_name != 'all'){
            $advertisements->where('page', $request->page_name);
        }
        if($request->status && $request->status != 'all'){
            $advertisements->where('status', $request->status);
        }
        $perPage = 15;
        if($request->show){
            $perPage = $request->show;
        }
        $advertisements = $advertisements->paginate($perPage);
        $pages = Page::where('status', 1)->get();
        return view('user.addvertisement.addvertisement-list')->with(compact('advertisements', 'pages'));
    }
 

    public function store(Request $request)
    {

        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'position' => 'required',
        ]);

        $start_date = Carbon::parse($request->start_date);
        $days = $start_date->diffInDays($request->end_date);
        $amount = (100 * $days);

        $data = new Addvertisement();
        $data->user_id = Auth::id();
        $data->amount = $amount;
        $data->ads_name = "link ad";
        $data->adsType = "image";
        $data->page = "all";
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->position = $request->position;
        $data->mobile_position = $request->mobile_position;
        $data->redirect_url = $request->redirect_url;
        $data->created_by = Auth::id();
        $data->status = "pending";
        if($request->hasFile('desktop_image')) {
            $image = $request->file('desktop_image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $image_name);

            $data->image = $image_name;
        }

        if($request->hasFile('mobile_image')) {
            $image = $request->file('mobile_image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $image_name);

            $data->mobile_image = $image_name;
        }

        $store = $data->save();
       
        if($store){
            
            $data = [
                'ad_id' => $data->id,
                'total_price' => $amount,
                'currency' => config('siteSetting.currency'),
                'payment_method' => $request->payment_method
            ];
            Session::put('payment_data', $data);
        }else{
            Toastr::error('Payment failed.');
            return redirect()->back();
        }

        if($request->payment_method == 'paypal'){
            //redirect PaypalController for payment process
            $paypal = new PaypalController;
            return $paypal->paypalPayment();
        }
        elseif($request->payment_method == 'masterCard'){

            if($request->paymentCard && $request->paymentCard != "other"){
                $request = json_decode($request->paymentCard, true);
            }
            
            Session::put('payment_data.card_number', $request["card_number"]);
            Session::put('payment_data.cvc', $request["cvc"]);
            Session::put('payment_data.month', $request["month"]);
            Session::put('payment_data.year', $request["year"]);

            //redirect StripeController for payment process
            $stripe = new StripeController();
            return $stripe->masterCardPayment();
        }
        else{
            Session::put('payment_data.payment_method', $request->payment_method);
            Session::put('payment_data.status', 'success');
            Session::put('payment_data.payment_status', 'pending');
            Session::put('payment_data.trnx_id', $request->trnx_id);
            Session::put('payment_data.payment_info', $request->payment_info);
            //redirect payment success method
            return $this->paymentSuccess();
        }
        return back();
    }

    public function edit($id)
    {  
        $data = Addvertisement::find($id);
        $pages = Page::where('status', 1)->get();
        return view('admin.addvertisement.addvertisement-edit')->with(compact('data', 'pages'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'adsType' => 'required',
            'page' => 'required',
            'position' => 'required'
        ]);
        $data = Addvertisement::find($request->id);
        
        $data->ads_name = $request->ads_name;
        $data->adsType = $request->adsType;
        $data->page = $request->page;
        $data->position = $request->position;
        $data->mobile_position = $request->mobile_position;
        $data->redirect_url = $request->redirect_url;
        $data->clickBtn = $request->clickBtn;
        $data->add_code =  $request->add_code;
        $data->updated_by = Auth::guard('admin')->id();
        $data->status = ($request->status) ? '1' : '0';
        
        if($request->hasFile('image')) {
            
            //delete from store folder
            if ($data->image){
                $image_path = public_path('upload/marketing/' . $data->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                } 
            }
           
            $image = $request->file('image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $image_name);

            $data->image = $image_name;
        }

        if($request->hasFile('mobile_image')) {
            
            //delete from store folder
            if ($data->mobile_image){
                $image_path = public_path('upload/marketing/' . $data->mobile_image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                } 
            }
           
            $image = $request->file('image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $image_name);

            $data->mobile_image = $image_name;
        }


        $data->save();

        Toastr::success('Addvertisement updated Successful.');
        return back();
    }



    public function delete($id)
    {
        $get_ads = Addvertisement::find($id);
        

        if($get_ads){
            //delete from store folder
            if ($get_ads->image){
                $image_path = public_path('upload/marketing/' . $get_ads->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                } 

                $image_path = public_path('upload/marketing/' . $get_ads->mobile_image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                } 
            }
            $get_ads->delete();
            $output = [
                'status' => true,
                'msg' => 'Ads deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Ads cannot deleted.'
            ];
        }
        return response()->json($output);
    }


    //payment status success then update payment status
    public function paymentSuccess(){

        $payment_data = Session::get('payment_data');

        //clear session payment data
        Session::forget('payment_data');
        if($payment_data && $payment_data['status'] == 'success') {
            
            $addvertisement = Addvertisement::where('id', $payment_data['ad_id'])->first();
            if ($addvertisement) {
                $user_id = $addvertisement->user_id;
                $addvertisement->payment_method = $payment_data['payment_method'];
                $addvertisement->tnx_id = (isset($payment_data['trnx_id'])) ? $payment_data['trnx_id'] : null;
                $addvertisement->payment_status = (isset($payment_data['payment_status'])) ? $payment_data['payment_status'] : 'pending';
                $addvertisement->payment_info = (isset($payment_data['payment_info'])) ? $payment_data['payment_info'] : null;
                $addvertisement->save();

                Toastr::success('Your link ad has been successfully completed.');
                return redirect()->route('post.list');
            }
        }
        Toastr::error('Sorry payment failed.');
        return redirect()->route('post.create')->with('error', 'Sorry payment failed.');
    }
}
