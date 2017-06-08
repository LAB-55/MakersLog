<?php

namespace App\Helpers;
use Request;
use Session;
use Auth;
class Meta
{
    public static function get( $title ){

        if (Auth::check()) {
                return [
                'title' => $title,
                'pageName' => $title,
                'email' => Auth::user()->email,
                'firstName' => Auth::user()->first_name,
                'lastName' => Auth::user()->last_name,
                'gusermail' => Auth::user()->g_username,
                'avatar'    => str_replace("sz=100", "" , Auth::user()->avatar),
                'website' => Auth::user()->website,
                'bio' => Auth::user()->bio,
                'gender' => Auth::user()->gender,
                'birthday' => Auth::user()->birthday,
                'mobileNumber' => Auth::user()->mobileNumber,
            ];
        }
        return [
            'title' => $title,
            'pageName' => $title, 
        ];
        
       
    }
}
