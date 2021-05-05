<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dummyAPI extends Controller
{
    //
    function getDemo(){
    	return ["name"=> "hello","email"=> "hello@gmail.com"];

    }
}
