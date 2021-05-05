<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shops;
use App\Helpers\APIHelpers;

class shopCtrl extends Controller
{
    
    
	// list all shops or shop by Id
    function listshops(Request $req, $id=null){

    	$uri= $req->path();
        $method=$req->method();     	
    	$result=$id?shops::find($id):shops::all();
    	if($result){ 

	    	$response=APIHelpers::createAPIResponse(1,200,$uri,$method,$result,null,(microtime(true) - LARAVEL_START)*1000);
	        return response()->json($response, 200);  

        }else{

            $result=(object) array();
            $error =  [
                    "message"=> "The resource that matches the request ID does not found.",
                    "code"=> 404002
                    ];
            $response=APIHelpers::createAPIResponse(0,404,$uri,$method,$result,$error,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 404);          
        }    

    }

    // create shop
    function addshops(Request $req){
    	
    	$uri= $req->path();
        $method=$req->method();  

    	$sp=new shops;    	
    	$sp->admin_id=2;
    	$sp->name= $req->get('name');
    	$sp->query=$req->get('query');
    	$sp->latitude= $req->get('latitude');
    	$sp->longitude=$req->get('longitude');
    	$sp->zoom=$req->get('zoom');    
    	$result=$sp->save();
    	if($result){
             $data = ["id"=> $sp->id];

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

    
    //update shop
    function updateshops(Request $req ,$id){
    	$uri= $req->path();
        $method=$req->method();  

    	$sp=shops::find($id);
    	if(is_null($sp)){            
            $result=(object) array();
            $error =  [
                    "message"=> "The request parameters are incorrect, please make sure to follow the documentation about request parameters of the resource.",
                    "code"=> 400002
                    ];
            $response=APIHelpers::createAPIResponse(0,400,$uri,$method,$result,$error,(microtime(true) - LARAVEL_START)*1000);
            return response()->json($response, 400);
        }  

    	$sp->name= $req->get('name');
    	$sp->query=$req->get('query');
    	$sp->latitude= $req->get('latitude');
    	$sp->longitude=$req->get('longitude');
    	$sp->zoom=$req->get('zoom');
		$result=$sp->save();
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

    function deleteshops(Request $req,$id){

    	$uri= $req->path();
        $method=$req->method();  
		$sp=shops::find($id);
		if ($sp != null) {

            $data=$sp->delete();
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
