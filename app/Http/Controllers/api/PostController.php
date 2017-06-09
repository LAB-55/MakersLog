<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\CategoryMap;
use Auth;
use Uuid;

class PostController extends Controller
{
    public function create(Request $r)
    {
    	try {
	    	$input['p_id']=Uuid::generate(5,Auth::user()->g_username . $r->p_title, Uuid::NS_DNS);
	    	$input['provider_id']=Auth::user()->provider_id;
	    	$input['p_title']=$r->p_title;
	    	$input['p_short_dec']=$r->p_short_desc;
	    	$input['p_content']=$r->p_content;
	    	$input['uri']= str_slug($r->p_title, "-");
	    	$t=time();
	    	$input['created_at']=$t;
	    	$input['updated_at']=$t;
	    	$i_cat = [];
				
				foreach ($r->categories as $key => $value)
	    			array_push($i_cat, $value['c_name']);
	    	
	    	$input['categories']=implode(',',$i_cat ).",";
	    	$id=Post::insertGetId($input);
	    	foreach ($i_cat as $key => $cname) {
	    		$catmap=new CategoryMap;
	    		$catmap->p_id=$input['p_id'];
	    		$catmap->provider_id=$input['provider_id'];
	    		$catmap->c_name = $cname;
	    		$catmap->save();
	    	}
    		return(['status'=>'1']);
    		
    	} catch (Exception $e) {
    		return(['status'=>'0','error'=>$e]);
    	}
    	
    	
    }
    public function update(Request $r)
    {
    	try {
	    	$input['p_id']=$r->p_id;
	    	$input['provider_id']=Auth::user()->provider_id;
	    	$input['p_title']=$r->p_title;
	    	$input['p_short_dec']=$r->p_short_desc;
	    	$input['p_content']=$r->p_content;
	    	$input['uri']= str_slug($r->p_title, "-");
	    	$c_at=Post::select('created_at')->first();
	    	$t=time();
	    	$input['created_at']=$c_at;
	    	$input['updated_at']=$t;
	    	Post::where('p_id',$input['p_id'])->update(['is_latest' => '0']);
	    	$input['categories']=implode(',', $r->categories).",";
	    	$id=Post::insertGetId($input);
	    	$cats=$r->categories;
	    	CategoryMap::where('p_id',$input['p_id'])->delete();
	    	foreach ($cats as $key => $cname) {
	    		$catmap=new CategoryMap;
	    		$catmap->p_id=$input['p_id'];
	    		$catmap->provider_id=$input['provider_id'];
	    		$catmap->$cname;
	    		$catmap->save();
	    	}
    		return(['status'=>'1']);
    		
    	} catch (Exception $e) {
    		return(['status'=>'0','error'=>$e]);
    	}
    }
}
