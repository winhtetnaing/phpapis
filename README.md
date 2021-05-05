# phpapis


api/coupons                       | coupons.index   | App\Http\Controllers\couponsCtrl@index                         | api        |
|        | POST      | api/coupons                       | coupons.store   | App\Http\Controllers\couponsCtrl@store                         | api        |
|        | GET|HEAD  | api/coupons/{coupon}              | coupons.show    | App\Http\Controllers\couponsCtrl@show                          | api        |
|        | PUT|PATCH | api/coupons/{coupon}              | coupons.update  | App\Http\Controllers\couponsCtrl@update                        | api        |
|        | DELETE    | api/coupons/{coupon}              | coupons.destroy | App\Http\Controllers\couponsCtrl@destroy                       | api        |
|        | POST      | api/coupons/{cp_id}/shops         |                 | App\Http\Controllers\coupon_shopsCtrl@create_coupon_shops      | api        |
|        | DELETE    | api/coupons/{cp_id}/shops/{id}    |                 | App\Http\Controllers\coupon_shopsCtrl@delete_coupon_shops      | api        |
|        | GET|HEAD  | api/coupons/{cp_id}/shops/{sp_id} |                 | App\Http\Controllers\coupon_shopsCtrl@show_couponId_by_shopsId | api        |
|        | GET|HEAD  | api/coupons/{id}/shops            |                 | App\Http\Controllers\coupon_shopsCtrl@show_coupon_by_allshops  | api        |
|        | GET|HEAD  | api/dummy
