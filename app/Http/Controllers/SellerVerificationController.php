<?php

namespace App\Http\Controllers;

use App\Models\SellerVerification;
use Illuminate\Http\Request;
use App\User;
use App\Models\Area;
use App\Models\City;
use App\Models\State;
use App\Models\PaymentGateway;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageEmail;
use Image;
use Session;
use App\Traits\CreateSlug;
use Carbon\Carbon;
class SellerVerificationController extends Controller
{
    public function verifyAccount()
    {
        $data['user'] = User::with("sellerVerify")->find(Auth::id());

        $region = ($data['user']->sellerVerify) ? $data['user']->sellerVerify->region : 0;
       
        $data['states'] = State::orderBy('position', 'desc')->where('status', 1)->get();
        $data['cities'] = City::where('state_id', $region )->where('status', 1)->get();
         $data['paymentgateways'] = PaymentGateway::orderBy('position', 'asc')->where('method_for', '!=', 'payment')->where('status', 1)->get();
        return view('users.seller-verify')->with($data);
    }

    public function verifyAccountRequest(Request $request){

        $request->validate([
            'name' => 'required',
            'shop_name' => 'required',
        ]);


        $start_date = Carbon::parse(now());
        $member_date = Carbon::parse(Auth::user()->created_at);
        $days = $start_date->diffInDays($member_date); //first 30 days member can get free membership

        $total_price = 0;
        if($days > 30){
            $total_price = $request->total_price;
        }

        $end_date = Carbon::parse(now())->addDays(30)->format("Y-m-d");
        
        $user = new SellerVerification();
        $user->seller_id = Auth::id();
        $user->membership = $request->membership;
        $user->verify_date = now();
        $user->end_date = $end_date;
        $user->amount = $total_price;
        $user->name = $request->name;
        $user->shop_name = $request->shop_name;
        $user->shop_about = $request->shop_about;
        $user->mobile = $request->mobile;
        $user->email = $request->email;

        $user->open_time= $request->open_time;
        $user->close_time= $request->closed_time;
        $user->open_days= json_encode($request->open_days);
        $user->region = $request->region;
        $user->city = $request->city;
        $user->address= $request->address;
        $user->activation = 0;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->owner_photo = $new_image_name;
        }

        if ($request->hasFile('nid_front')) {
            $image = $request->file('nid_front');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->nid_front = $new_image_name;
        }if ($request->hasFile('nid_back')) {
            $image = $request->file('nid_back');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->nid_back = $new_image_name;
        }if ($request->hasFile('trade_license')) {
            $image = $request->file('trade_license');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->trade_license = $new_image_name;
        }if ($request->hasFile('trade_license2')) {
            $image = $request->file('trade_license2');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->trade_license2 = $new_image_name;
        }if ($request->hasFile('trade_license3')) {
            $image = $request->file('trade_license3');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->trade_license3 = $new_image_name;
        }

        $update =$user->save();
        if($update){
            Toastr::success('Account verify request send successful.');
        }else{
            Toastr::error('Sorry account verify request failed.');
        }
        return back();
    }

}
