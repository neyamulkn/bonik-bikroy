<?php

namespace App\Http\Controllers;

use App\Models\SellerVerification;
use Illuminate\Http\Request;
use App\User;
use App\Models\Membership;
use App\Models\MembershipDuration;
use App\Models\City;
use App\Models\State;
use App\Models\PaymentGateway;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageEmail;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\SellerMembershipController;
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
        $data['memberships'] = Membership::with('membershipDurations')->where('status', 1)->get();
        $data['states'] = State::orderBy('position', 'desc')->where('status', 1)->get();
        $data['cities'] = City::where('state_id', $region )->where('status', 1)->get();
         $data['paymentgateways'] = PaymentGateway::orderBy('position', 'asc')->where('method_for', '!=', 'payment')->where('status', 1)->get();
        return view('users.seller-verify')->with($data);
    }

    public function verifyAccountRequest(Request $request){

        $request->validate([
            'name' => 'required',
            'shop_name' => 'required',
            'membership' => 'required',
        ]);
        
        $user = SellerVerification::where("seller_id", Auth::id())->first();
        if(!$user){
            $user = new SellerVerification();
        }
        //free 30 days membership
        $end_date = Carbon::parse(now())->addDays(30)->format("Y-m-d");

        $user->seller_id = Auth::id();
        $user->membership = $request->membership;
        $user->end_date = $end_date;
        $user->verify_date = now();
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
        $user->status= "pending";
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

        $store = $user->save();
        if($store){
            
            //if membership is not free
            if($request->payment_method){

                $membershipDuration = MembershipDuration::find($request->membershipDuration);
                $duration = 30;
                if($membershipDuration){
                    $duration = ($membershipDuration->type == 'month') ? ($membershipDuration->duration * 30) : $membershipDuration->duration;
                }
                $end_date = Carbon::parse(now())->addDays($duration)->format("Y-m-d");
                $total_price = $membershipDuration->price;
              
                $sellerMembership = new SellerMembership();
                $sellerMembership->seller_id = Auth::id();
                $sellerMembership->membership = $request->membership;
                $sellerMembership->start_date = now();
                $sellerMembership->end_date = $end_date;
                $sellerMembership->amount = $total_price;
                $sellerMembership->payment_method = ($request->payment_method) ? $request->payment_method : "free";
                $sellerMembership->save();

                $data = [
                    'membership_id' => $sellerMembership->id,
                    'total_price' => $total_price,
                    'currency' => config('siteSetting.currency'),
                    'payment_method' => ($request->payment_method) ? $request->payment_method : "free"
                ];
                Session::put('payment_data', $data);
            
                if($request->payment_method == 'paypal'){
                    //redirect PaypalController for payment process
                    $paypal = new PaypalController;
                    return $paypal->paypalPayment();
                }
                else{
                    Session::put('payment_data.status', 'success');
                    Session::put('payment_data.payment_status', 'pending');
                    Session::put('payment_data.trnx_id', $request->trnx_id);
                    Session::put('payment_data.payment_info', $request->payment_info);

                    //redirect payment success method
                    $membershipPayment = new SellerMembershipController;
                    return $membershipPayment->paymentSuccess();
                }
            }
            Toastr::success('Account verify request send successful.');
        }else{
            Toastr::error('Sorry account verify request failed.');
        }
        return back()->with("success", "Your account verify request send successful.");
    }

}
