<?php

namespace App\Helpers;
use Request;
use Session;
use Auth;
class Meta
{
    public static function get( $title ){
        // Request::
       return [
            'title' => $title,
            'pageName' => $title,
            'firstName' => Auth::user()->first_name,
            'lastName' => Auth::user()->last_name,
            'gusermail' => Auth::user()->g_username,
            'avatar'    => Auth::user()->avatar
        ];
    }
}
