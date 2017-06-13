<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Helpers\Meta;
use App\User;
use App\Presentation;
use App\Task;
use Auth;
use Session;
use Redirect;

class TasksController extends Controller
{
    public function showTasks($gusermail) {
    	if (Auth::check() && Auth::user()->g_username == $gusermail) {
    		$provider_id = User::Select('provider_id')
        							->Where('g_username', $gusermail)
        							->first()->toArray();
			$tasks = Task::Select('*')
									->Where('provider_id', $provider_id['provider_id'])
									->get();
            return view('task')
            		->with('tasks', $tasks)
            		->with('meta',Meta::get('Kalpit Akhawat / New Log'));
        }
        else {
            return redirect(route('gusermail', ['gusermail' => $gusermail]));
        }
    }
}
