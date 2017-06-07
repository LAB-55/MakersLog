<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
class SearchController extends Controller
{
    public function index(Request $r)
    {
      try {
        if($r->type=="user"){
          return(['status'=>'1' , "collection" =>$this->byUser($r) ]);
        } elseif ($r->type=="post") {
                
        }else{
          return json(['status'=>'0','error'=>"Undefined Search Category"]);
        }     	
      } catch (Exception $e) {
      	return json(['status'=>'0','error'=>$e]);
      }
    }
    public function byUser($r)
    {
      $txt=$r->text;
      $offset=$r->offset;
      $limit=$r->limit;
      $result=User::where('first_name','like','%'.$txt.'%')->orWhere('last_name','like','%'.$txt.'%')->orWhere('g_username','like','%'.$txt.'%')->offset($offset)->limit($limit)->get();
      return $result;
    }
}
