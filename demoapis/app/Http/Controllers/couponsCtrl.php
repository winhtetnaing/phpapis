<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\coupons;
use App\Helpers\APIHelpers;
class couponsCtrl extends Controller
{
    
    public function index(Request $req)
    {
        $uri= $req->path();
        $method=$req->method();        
        $data=coupons::all(); 
        $response=APIHelpers::createAPIResponse(1,200,$uri,$method,$data,null,(microtime(true) - LARAVEL_START)*1000);
        return response()->json($response, 200);        
    }

    public function store(Request $req)
    {
        $uri= $req->path();
        $method=$req->method();  

        $cp=new coupons;      
        $cp->admin_id=3;
        $cp->name= $req->get('name');
        $cp->description=$req->get('description');
        $cp->discount_type= $req->get('discount_type');
        $cp->amount=$req->get('amount');
        $cp->image_url=$req->get('image_url');
        $cp->code= $req->get('code');
        $cp->start_datetime=$req->get('start_datetime');
        $cp->end_datetime= $req->get('end_datetime');
        $cp->coupon_type=$req->get('coupon_type');
        $cp->used_count=$req->get('used_count');    
        $result=$cp->save();   
        if($result){
             $data = ["id"=> $cp->id];

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
    
    public function show(Request $req, $id)
    {
      
        $uri= $req->path();
        $method=$req->method();      
        $result= coupons::find($id);
        if($result){            
            $response=APIHelpers::createAPIResponse(1,200,$uri,$method,$result,null,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 200);
        }
        else{

            $result=(object) array();
            $error =  [
                    "message"=> "The resource that matches the request ID does not found.",
                    "code"=> 404002
                    ];
            $response=APIHelpers::createAPIResponse(0,404,$uri,$method,$result,$error,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 404);
          
        }
       
    }
    
    public function update(Request $req, $id)
    {
        $uri= $req->path();
        $method=$req->method(); 

        $cp=coupons::find($id); 
        if(is_null($cp)){            
            $result=(object) array();
            $error =  [
                    "message"=> "The request parameters are incorrect, please make sure to follow the documentation about request parameters of the resource.",
                    "code"=> 400002
                    ];
            $response=APIHelpers::createAPIResponse(0,400,$uri,$method,$result,$error,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 400);
        }  

        $cp->name= $req->get('name');
        $cp->description=$req->get('description');
        $cp->discount_type= $req->get('discount_type');
        $cp->amount=$req->get('amount');
        $cp->image_url=$req->get('image_url');
        $cp->code= $req->get('code');
        $cp->start_datetime=$req->get('start_datetime');
        $cp->end_datetime= $req->get('end_datetime');
        $cp->coupon_type=$req->get('coupon_type');
        $cp->used_count=$req->get('used_count');    
        $result=$cp->save();
        if($result){
             $data = ["updated"=> 1];
            $response=APIHelpers::createAPIResponse(1,200,$uri,$method,$data,null,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 200);

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

   
    public function destroy(Request $req, $id)
    {
        $uri= $req->path();
        $method=$req->method();  

        $cp=coupons::find($id);

        if ($cp != null) {

            $data=$cp->delete();
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
}
