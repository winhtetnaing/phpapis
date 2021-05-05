<?php

namespace App\Helpers;

class APIHelpers{

	public static function createAPIResponse($status,$code,$endpoint,$uri,$content,$message,$duration){

			$result=[];

			$meta=[];
			$meta['method']=$uri;
			$meta['endpoint']=$endpoint;

			$result['success']=$status;
			$result['code']=$code;
			$result['meta']=$meta;			
			$result['data']=$content;		
			
			if (is_null($message)){

				$result['errors']=(object) array();

			}else{
				$result['errors']=$message;
			}			
			
			$result['duration']=$duration;	

			return $result;
		

	}

	public static function changeAPIResponse($status,$code,$meta,$content,$message,$duration){

			$result=[];

			$result['meta']=$meta;

			$result['success']=$status;
			$result['code']=$code;
			$result['meta']=$meta;			
			$result['data']=$content;		
			
			if (is_null($message)){

				$result['errors']=(object) array();

			}else{
				$result['errors']=$message;
			}			
			
			$result['duration']=$duration;	

			return $result;
		

	}

}