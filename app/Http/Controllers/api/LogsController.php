<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;

class LogsController extends Controller
{
    public function index($gusermail)
    {
    	try {

	    	$user = User::Select('*')->Where('g_username', $gusermail)->first();
	    	if (isset($user->provider_id)) {
	    		$logs = Post::Select('*')
	    						->Where('provider_id', $user->provider_id)
	    						->Where('is_latest', '1')
	    						->Where('delete', '0')
								->orderBy('created_at', 'desc')
	    						->get();
		    	
		    	return ['status'=>'1' , "collection" =>$logs ];
	    	}
		    return ['status'=>'0' , "error" =>'404' ];	
    	}
    	catch (Exception $e) {
      		return json(['status'=>'0','error'=>$e]);
      	}

    }
}
