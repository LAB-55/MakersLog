<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use app\Category;

class CategoryController extends Controller
{
    public function index()
    {
    	
    }
    public function create(Request $r)
    {
    	try {
    		$input['c_name']=$r->c_name;
	    	$id=Category::insertGetId($input);
    		return json(['status'=>'1']);
    	} catch (Exception $e) {
    		return json(['status'=>'0','error'=>$e]);
    	}

    }
}
