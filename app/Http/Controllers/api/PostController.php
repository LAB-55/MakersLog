<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function create(Request $r)
    {
    	$input['p_title']=$r->p_title;
    	$input['p_short_desc']=$r->p_short_desc;
    	$input['p_content']=$r->p_content;
    	
    	
    }
}
