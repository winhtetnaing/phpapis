<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\coupon_shops;
use App\Models\coupons;
use App\Models\shops;
use App\Helpers\APIHelpers;

class coupon_shopsCtrl extends Controller
{
    
    function create_coupon_shops(Request $req){
    	
    	$uri= $req->path();
        $method=$req->method();  

    	$cpsp=new coupon_shops;    	
    	
    	$cpsp->coupon_id= $req->get('coupon_id');
    	$cpsp->shop_id=$req->get('shop_id');    	
    	$result=$cpsp->save();
    	if($result){
             $data = ["id"=> $cpsp->id];

            $response=APIHelpers::createAPIResponse(1,201,$uri,$method,$data,null,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 201);

        }else{

           $result=(object) array();
            $error =  [
                    "message"=> "The updating resource that corresponds to the ID wasn't found.",
                    "code"=> 404002
                    ];
            $response=APIHelpers::createAPIResponse(0,404,$uri,$method,$result,$error,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 404);

        }
    }


    function delete_coupon_shops(Request $req,$cp_id,$id){

    	$uri= $req->path();
        $method=$req->method();  
		
		$cpsp = coupon_shops::where('id', '=', $id)->orWhere ('coupon_id', '=', $cp_id);		
		if ($cpsp != null) {

            $data= $cpsp->delete();

            $result =  [
                    "deleted"=> 1                    
                    ];

            $response=APIHelpers::createAPIResponse(1,200,$uri,$method,$result,null,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 200);
        }else{
            $result=(object) array();
            $error =  [
                    "message"=> "there are no coupon specified",
                    "code"=> 404002
                    ];
            $response=APIHelpers::createAPIResponse(0,404,$uri,$method,$result,$error,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 404);
        }
    }


    public function show_coupon_by_allshops(Request $req, $id)
    {
      
        $result=[];
        $meta=[];        
        $meta["method"]=$req->method();
        $meta["endpoint"]= $req->path();

        $limit=$req->get('limit');
        $meta["limit"]= $limit;

        $offset=$req->get('offset');
        $meta["offset"]= $offset;

        $cp=coupons::find($id);      
        $cpsp= coupon_shops::select('id')->where('coupon_id', '=', $id);  


    	//$sp = shops::whereIn('id',$cpsp)->orderByRaw('id')->limit($limit)->get();  
        $sp = shops::whereIn('id',$cpsp)->orderByRaw('id')->skip($offset)->take($limit)->get();
        
        $result=$cp;
		$result["shops"]=$sp;
		$meta["total"]=$sp->count();


        $response=APIHelpers::changeAPIResponse(1,200,$meta,$result,null,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 200);
     
       
    }


    public function show_couponId_by_shopsId(Request $req, $cp_id,$sp_id)
    {      
        $result=[];
        $uri= $req->path();
        $method=$req->method();  

        $cp=coupons::find($cp_id);      
        $sp=shops::find($sp_id);        
        $result=$cp;
		$result["shops"]=$sp;		

        $response=APIHelpers::createAPIResponse(1,200,$uri,$method,$result,null,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 200);
     
       
    }


}
