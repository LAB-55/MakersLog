<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $r)
    {
      try {
      	$txt=$r->text;
      	$type=$r->type;
      	$categories=$r->categories;
      } catch (Exception $e) {
      	
      }
    }
}
