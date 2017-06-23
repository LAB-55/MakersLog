<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Meta;

class ContributorController extends Controller
{
    public function contributors() {
    	$client = new \Guzzle\Service\Client();
    	$request = $client->get('https://api.github.com/repos/LAB-55/MakersLog/contributors');
  		$response = $request->send();
  		$result = $response->json();
    	// print_r($data[0]['login']);
     	// exit();
    	return view('contributor')->with('contributors', $result)->with('meta', Meta::get());
    }
}
