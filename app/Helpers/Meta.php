<?php

namespace App\Helpers;
use Request;
use Session;
use Auth;
use Route;
use App\User;
use App\Presentation;
use App\Post;

class Meta
{
    public static function get(){
        
        $meta = [];
        $route = Route::currentRouteName();
        // dd(Route::parameters());
            if (Auth::check()) {
                $AuthUser = Auth::user();
                $meta = [
                        'email' => $AuthUser->email,
                        'firstName' => $AuthUser->first_name,
                        'lastName' => $AuthUser->last_name,
                        'gusermail' => $AuthUser->g_username,
                        'avatar'    => $AuthUser->avatar,
                        'website' => $AuthUser->website,
                        'bio' => $AuthUser->bio,
                        'gender' => $AuthUser->gender,
                        'birthday' => $AuthUser->birthday,
                        'mobileNumber' => $AuthUser->mobile_number,
                ];
            }
            // dd($route);
            switch ($route) {
                case 'indexroot':
                    $meta['title'] = "MakersLog | Light on what Makers Make";
                    $meta['pageName'] = "Search";
                    break;
                
                case 'createLog':
                    $meta['title'] = "New Log | MakersLog";
                    $meta['pageName'] = $AuthUser->first_name." ".$AuthUser->last_name." / New Log";
                    break;

                case 'editLog':
                    $meta['title'] = "Edit Log | MakersLog";
                    $meta['pageName'] = $AuthUser->first_name." ".$AuthUser->last_name." / Edit Log ";
                    break;

                case 'login':
                    $meta['title'] = "Login | MakersLog";
                    break;

                case 'gusermail':
                    $user = User::where('g_username', Request::route('gusermail'))->first();

                    $meta['title'] = "Logs from ".$user->first_name." ".$user->last_name." | MakersLog";
                    $meta['pageName'] = $user->first_name." ".$user->last_name;
                    break;

                case 'getProfile':
                    $meta['title'] = "Edit Profile | MakersLog";
                    $meta['pageName'] = $AuthUser->first_name." ".$AuthUser->last_name." / Edit Profile";
                    break;

                case 'presentations':
                    $meta['title'] = "Presentations | MakersLog";
                    $meta['pageName'] = $AuthUser->first_name." ".$AuthUser->last_name." / Presentations";
                    break;

                case 'presentationView':
                    $p = Presentation::where('presentation_id', Request::route('presentation_id'))->first();
                    $meta['title'] = "Presentation of ".$p['title']." | MakersLog";
                    $meta['pageName'] = $AuthUser->first_name." ".$AuthUser->last_name." / Presentation View";
                    break;

                case 'tasks':
                    $meta['title'] = "Tasks | MakersLog";
                    $meta['pageName'] = $AuthUser->first_name." ".$AuthUser->last_name." / Tasks";
                    break;

                case 'individial':
                    $meta['title'] = str_replace("-", " ", Request::route('slug') )." | MakersLog";
                    $meta['pageName'] = " / ";
                    break;
                                        
                default:
                    # code...
                    break;
            }
            return $meta;

        // elseif () {
            
        // }
        // >name('createLog');
        // return [
        //     'title' => $title,
        //     'pageName' => $title, 
        // ];
        
       
    }
}
