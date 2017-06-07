<?php

namespace App\Helpers;
use Request;
use Session;
class Meta
{
    public static function get( $title ){
        // Request::
       return [
            'title' => $title,
            'pageName' => $title,
            'firstName' => 'Kalpit',
            'lastName' => 'Akhawat',
            'gusermail' => 'kalpitakhawat',
            'avatar'    => 'https://avatars0.githubusercontent.com/u/16951479?v=3&s=460'
        ];
    }
}
