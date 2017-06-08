<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Meta;
use Auth;


class ProfileController extends Controller
{
    public function index() {
    	return view('profile')->with('meta',Meta::get('Kalpit Akhawat / New Log'));
    }
}
