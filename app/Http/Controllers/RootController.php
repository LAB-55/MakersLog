<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Meta;

class RootController extends Controller
{
	

	public function index( Request $r )
	{
		if(isset($_GET['auth']) && isset($_GET['failed']) )
		{
			return redirect("/");
		}
		return view('search')
	    		->with('meta',Meta::get('Search') );
	}

	public function userpage($gusermail) 
	{
		//$u = select from user where u_user=$gusermail 
    	return view('userpage')
    			->with('meta',Meta::get("") );
	}
}
