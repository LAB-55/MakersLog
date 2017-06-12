<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Meta;
use Auth;
use App\Post;
use App\User;
class PostController extends Controller
{
    public function index(){
	    return view('newpost')
	    		->with('meta',Meta::get('Kalpit Akhawat / New Log'));
    }
    public function individual( $gusermail, $pid, $slug ){

        $aPost = Post::where('p_id', $pid)
                    ->where('is_latest','1')->where('delete','0')->first();
                    // print_r($aPost);
        $userDetails = User::where('provider_id',$aPost->provider_id)->first();
                if( $aPost ){

                    return view('individual')
                            ->with('p',$aPost)
                            ->with('u',$userDetails)
                            ->with('meta',Meta::get('Log'));
                }else{
                    return '<h1>404 Not found.</h1>';
                }
    }
    public function validateInitial()
    {
        if( Auth::check() ){
            return (["say"=> base64_encode("barobar che. agal java de") ]) ;
        }
        return (["say"=> base64_encode("bhai e back button maryu.") ]);
    }
}