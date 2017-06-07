<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Meta;

class PostController extends Controller
{
    public function index(){
	    return view('newpost')
	    		->with('meta',Meta::get('Kalpit Akhawat / New Log'));
    }
}
