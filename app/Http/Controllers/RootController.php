<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Meta;
use App\User;
use App\Post;
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
		$user=User::where('g_username',$gusermail)->first();
		$post=Post::where('provider_id',$user->provider_id)->where('is_latest','1')->where('delete','0')->get();
		$count=Post::where('provider_id',$user->provider_id)->where('is_latest','1')->where('delete','0')->count();
    	return view('userpage')
    			->with('meta',Meta::get(""))->with('user',$user)->with('post',$post)->with('postcount',$count);
	}
}
