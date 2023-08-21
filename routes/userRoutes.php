<?php

use Illuminate\Support\Facades\Route;

Route::get('login', 'User\UserLoginController@LoginForm')->name('LoginForm');
Route::post('user/login', 'User\UserLoginController@login')->name('userLogin');
Route::get('register', 'User\UserRegController@RegisterForm')->name('userRegisterForm');
Route::post('user/register', 'User\UserRegController@register')->name('userRegister');
Route::get('user/logout', 'User\UserLoginController@logout')->name('userLogout');


Route::get('resend/account/verify', 'User\UserRegController@resendVerifyToken')->name('resendVerifyToken');
Route::get('account/verify', 'User\UserRegController@userAccountVerify')->name('userAccountVerify');

//reset for
Route::get('password/recover', 'Auth\ForgotPasswordController@passwordRecover')->name('password.recover');
//forgot password notify send
Route::match(array('GET','POST'), 'password/recover/notify', 'Auth\ForgotPasswordController@passwordRecoverNotify')->name('password.recover');
//verify token or otp
Route::get('password/recover/verify', 'Auth\ForgotPasswordController@passwordRecoverVerify')->name('password.recoverVerify');
//passord update
Route::post('password/recover/update', 'Auth\ForgotPasswordController@passwordRecoverUpdate')->name('password.recoverUpdate');



Route::get('addto/compare/{product_id}', 'User\CompareController@addToCompare')->name('addToCompare');
Route::get('compare/product', 'User\CompareController@compare')->name('productCompare');
Route::get('compare/product/remove/{product_id}', 'User\CompareController@remove')->name('productCompareRemove');

route::group(['middleware' => ['auth']], function(){

	Route::post('/sslcommerz/success', 'SslCommerzPaymentController@success');
	Route::post('/sslcommerz/fail', 'SslCommerzPaymentController@fail');
	Route::post('/sslcommerz/cancel', 'SslCommerzPaymentController@cancel');
	Route::post('/sslcommerz/ipn', 'SslCommerzPaymentController@ipn');
    
    Route::get('shurjopay/payment/success', 'ShurjopayPaymentController@paymentSuccess')->name('shurjopayPaymentSuccess');

    Route::get('paycorp/payment/success', 'PaycorpController@paymentSuccess')->name('paymentSuccess');

	Route::post('package/purchase/{id}', 'PackagePurchaseController@packagePurchase')->name('packagePurchase');
	Route::get('package/payment/{order_id}', 'PackagePurchaseController@packagePurchasePaymentGateway')->name('packagePurchasePaymentGateway');
	Route::post('package/purchase/payment/{id}', 'PackagePurchaseController@packagePurchasePayment')->name('packagePurchasePayment');

	Route::get('package/purchase/history/{status?}', 'PackagePurchaseController@packagePurchaseHistory')->name('user.packageHistory');
	
	//message inbox
	Route::get('message/{username?}/{product?}', 'MessageController@conversationList')->name('user.message');
	Route::get('get/messages/{conversation_id}/{product?}', 'MessageController@getMessages')->name('user.getMessages');
	Route::post('send/message', 'MessageController@sendMessage')->name('user.sendMessage');
	Route::get('delete/message/{id}', 'MessageController@deleteMessage')->name('deleteMessage');
	Route::get('delete/all/message/{id}', 'MessageController@deleteAllMessage')->name('deleteAllMessage');
	Route::get('realtime/message', 'MessageController@realTimeMessage')->name('realTimeMessage');
	Route::get('block/user/{id}', 'MessageController@blockUser')->name('blockUser');


	Route::get('count/notification', 'NotificationController@countMessageNotification')->name('countMessageNotification');
	Route::get('get/notifications', 'NotificationController@getNotifications')->name('getNotifications');
	Route::get('notifications', 'NotificationController@allNotifications')->name('allNotifications');
	Route::get('read/notifications/{id?}', 'NotificationController@readNotify')->name('readNotify');

	Route::get('user/follower', 'ShopController@follower')->name('follower');

	Route::get('seller/report', 'ReportController@reportForm')->name('reportForm');
	Route::post('seller/report', 'ReportController@sellerReport')->name('sellerReport');

	Route::get('ads/promote/{adsSlug}', 'PromoteAdsController@adsPromotePackage')->name('ads.promotePackage');
	Route::post('ads/promote/{adsSlug}', 'PromoteAdsController@adsPromote')->name('ads.promote');
	Route::get('ads/promote/payment/{adsSlug}/{order_id}', 'PromoteAdsController@adsPromotePayment')->name('ads.promotePayment');

	Route::get('promote/ads/history/{package_slug?}', 'PromoteAdsController@adsPromoteHistory')->name('ads.promoteHistory');

	Route::get('seller/verification', 'SellerVerificationController@verifyAccount')->name('verifyAccount');
	Route::post('seller/verification', 'SellerVerificationController@verifyAccountRequest')->name('verifyAccount');
 		
	
	route::group(['namespace' => 'User'], function(){
		//user account
		Route::get('dashboard', 'UserController@dashboard')->name('user.dashboard');
		Route::get('user/profile', 'UserController@myAccount')->name('user.myAccount');
		Route::post('user/profile/update', 'UserController@profileUpdate')->name('user.profileUpdate');
		Route::post('user/address/update', 'UserController@addressUpdate')->name('user.addressUpdate');
		Route::get('user/change-password', 'UserController@changePasswordForm')->name('user.change-password');
		Route::post('user/change-password', 'UserController@changePassword')->name('user.change-password');
		//profile image change for all user
		Route::post('change/profile/image', 'UserController@changeProfileImage')->name('changeProfileImage');

		
 		Route::get('my/ads/{status?}', 'PostController@index')->name('post.list');
 		Route::match(["get", "post"], 'ads-post/{category?}/{subcategory?}', 'PostController@create')->name('post.create');
 		Route::post('post/store', 'PostController@store')->name('post.store');
 		Route::post('wanted/post/store', 'PostController@storeWantedPost')->name('storeWantedPost');
 		
 		Route::get('post/edit/{slug}', 'PostController@edit')->name('post.edit');
 		Route::post('post/update/{id}', 'PostController@update')->name('post.update');
 		Route::post('post/delete', 'PostController@delete')->name('post.delete');


 		Route::post('link/add', 'LinkAdController@store')->name('storeLinkAd');

 		Route::get('add/number', 'UserController@addNumber')->name('addNumber');
 		Route::get('verify/number', 'UserController@verifyNumber')->name('verifyNumber');

 		Route::get('add/email', 'UserController@addEmail')->name('addEmail');
 		Route::get('verify/email', 'UserController@verifyEmail')->name('verifyEmail');

		Route::get('addto/wishlist', 'WishlistController@store')->name('wishlist.add');
		Route::get('wishlist', 'WishlistController@index')->name('wishlists');
		Route::get('wishlist/remove/{id}', 'WishlistController@remove')->name('wishlist.remove');
		
		

		//blog routes
		Route::get('blog/list', 'BlogController@index')->name('blog.list');
 		Route::get('blog/create', 'BlogController@create')->name('blog.create');
 		Route::post('blog/store', 'BlogController@store')->name('blog.store');
 		Route::get('blog/edit/{slug}', 'BlogController@edit')->name('blog.edit');
 		Route::post('blog/update/{id}', 'BlogController@update')->name('blog.update');
 		Route::get('blog/delete/{id}', 'BlogController@delete')->name('blog.delete');

 		
	});
});





