<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dummyAPI;
use App\Http\Controllers\shopCtrl;
use App\Http\Controllers\couponsCtrl;
use App\Http\Controllers\coupon_shopsCtrl;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("dummy",[dummyAPI::class,'getDemo']);

// get shop list or by Id
Route::get("shops/{id?}",[shopCtrl::class,'listshops']);
//create shops
Route::post("shops",[shopCtrl::class,'addshops']);
//update shops
Route::put("shops/{id}",[shopCtrl::class,'updateshops']);
//delete shops
Route::delete("shops/{id}",[shopCtrl::class,'deleteshops']);

// coupons (Resources )
Route::apiResource("coupons",couponsCtrl::class);

//create coupon_shops
Route::post("coupons/{cp_id}/shops",[coupon_shopsCtrl::class,'create_coupon_shops']);

//delete coupon_shops
Route::delete("coupons/{cp_id}/shops/{id}",[coupon_shopsCtrl::class,'delete_coupon_shops']);
//get coupon_by all shops
Route::get("coupons/{id}/shops",[coupon_shopsCtrl::class,'show_coupon_by_allshops']);

//get couponId_by_shopsId
Route::get("coupons/{cp_id}/shops/{sp_id}",[coupon_shopsCtrl::class,'show_couponId_by_shopsId']);