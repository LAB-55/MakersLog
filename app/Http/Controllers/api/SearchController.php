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
          byPost($r);
        }else{
          return json(['status'=>'0','error'=>"Undefined Search Category"]);
        }     	
      } catch (Exception $e) {
      	return json(['status'=>'0','error'=>$e]);
      }
    }
    public function byUser($r)
    {
      $txt=$r->qry;
      $offset=$r->offset;
      $limit=$r->limit;
      $result=User::where('first_name','like','%'.$txt.'%')->orWhere('last_name','like','%'.$txt.'%')->orWhere('g_username','like','%'.$txt.'%')->offset($offset)->limit($limit)->get();
      foreach ($result as $key => $r) {
          $r->post_count=Post::where('provider_id',$r->provider_id)->count();
      }
      return $result;
    }
    public function byPost($r)
    {
      $txt=$r->qry;
      $offset=$r->offset;
      $limit=$r->limit;
      $cat=$r->categories;
      $result=DB::table('user')
              ->join('post_master','user.provider_id','=','post_master.provider_id')
                            ->where('post_master.p_title','like','%'.$txt.'%')
                            ->orWhere('post_master.p_short_dec','like','%'.$txt.'%')
                            ->orWhere('post_master.p_contect','like','%'.$txt.'%')->get();

    }
}
