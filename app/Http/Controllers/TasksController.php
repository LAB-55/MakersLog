<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Meta;
use App\User;
use App\Presentation;
use App\Task;
use Auth;
use Redirect;

class TasksController extends Controller
{
    public function index($gusermail) {
    	if (Auth::check() && Auth::user()->g_username == $gusermail) {
            return view('task')
            		->with('gusermail', $gusermail)
            		->with('meta',Meta::get('Kalpit Akhawat / New Log'));

        }
        else {
            return redirect(route('gusermail', ['gusermail' => $gusermail]));
        }
    }
}
