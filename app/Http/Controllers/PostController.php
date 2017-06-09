<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Meta;
use Auth;

class PostController extends Controller
{
    public function index(){
	    return view('newpost')
	    		->with('meta',Meta::get('Kalpit Akhawat / New Log'));
    }
    
    public function validateInitial()
    {

        if( Auth::check() ){
            return (["say"=> base64_encode("barobar che. agal java de") ]) ;
        }
        return (["say"=> base64_encode("bhai e back button maryu.") ]);
    }
}