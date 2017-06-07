<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
    	try {
           $cat=Category::all()->toArray();
           return(['status'=>'1' ,'data'=>$cat]);
        } catch (Exception $e) {
            return(['status'=>'0','error'=>$e]);
        }
    }
    public function create(Request $r)
    {
    	try {
    		$input['c_name']=$r->c_name;
	    	$id=Category::insertGetId($input);
    		return(['status'=>'1']);
    	} catch (Exception $e) {
    		return(['status'=>'0','error'=>$e]);
    	}

    }
}
