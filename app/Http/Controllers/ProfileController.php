<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Helpers\Meta;
use App\User;
use App\Presentation;
use Auth;
use Session;
use Redirect;
use Storage;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Exception;

define('APPLICATION_NAME', 'MakersLog');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
define('SCOPES', implode(' ', array(
  Google_Service_Drive::DRIVE_METADATA_READONLY)
));


class ProfileController extends Controller
{
    public function index($gusermail) {
    	if(Auth::check() &&  Auth::user()->g_username == $gusermail ) {
    		return view('profile')->with('meta',Meta::get('Kalpit Akhawat / New Log'));
    	}
    	else {
    		return redirect(route('gusermail', ['gusermail' => $gusermail]));
    	}
    }

    public function store(Request $request, $gusermail) {
    	User::where("g_username", $gusermail)->update([
            "first_name" => $request->firstName,
	    	"last_name" => $request->lastName,
	    	"email" => $request->email,
	    	"g_username" => $request->gusermail,
	    	"bio" => $request->bio,
	    	//"avatar" => $request->avatar,
	    	"website" => $request->website,
	    	"gender" => $request->gender,
	    	"birthday" => $request->birthday,
	    	"mobile_number" => $request->mobileNumber,
        ]);
    	return redirect( route('getProfile', ['gusermail' => $request->gusermail]) );
    }

    public function presentations($gusermail) {
        if(Auth::check() &&  Auth::user()->g_username == $gusermail ) {
            return view('presentations')->with('meta',Meta::get('Kalpit Akhawat / New Log'));
        }
        else {
            return redirect(route('gusermail', ['gusermail' => $gusermail]));
        }
    }

    public function getClient() {
        $client = new Google_Client();
        $client->setApplicationName(APPLICATION_NAME);
        $client->setScopes(SCOPES);
        $client->setAuthConfig(CLIENT_SECRET_PATH);
        $client->setAccessType('offline');
        $authUrl = $client->createAuthUrl();
        //$accessToken = env('GOOGLE_DRIVE_ACCESS_TOKEN');
        $refreshToken = env('GOOGLE_DRIVE_REFRESH_TOKEN');
        //$client->setAccessToken($accessToken);
        $client->fetchAccessTokenWithRefreshToken($refreshToken);
        $client->getAccessToken();
        return $client;
    }

    public function uploadPresentation(Request $request, $gusermail) {
        $title = $request->title;
        $file = Input::file('ppt');
        $extension = $file->extension();
        $filename = $title.'.'.$extension;
        //$filename = $file->getClientOriginalName();
        $file->move(public_path().'/presentation', $filename);
        
        $content = file_get_contents(public_path().'/presentation/'.$filename);

        $client = $this->getClient();
        $service = new Google_Service_Drive($client);

        $folderId = env('GOOGLE_DRIVE_FOLDER_ID');
        $fileMetadata = new Google_Service_Drive_DriveFile(array(
          'name' => $filename,
          'mimeType' => 'application/vnd.google-apps.presentation',
          'parents' => array($folderId)
        ));
        // dd($fileMetadata);
        $presentation = $service->files->create($fileMetadata, array(
          'data' => $content,
          'uploadType' => 'multipart',
          'fields' => 'id')
        );
        //dd($presentation);

        $presentation_id = $presentation->id;
        $presentation_url = 'https://docs.google.com/presentation/d/'.$presentation_id.'/embed?start=false&loop=false&delayms=3000';
        $thumbnail_url = 'https://lh3.google.com/u/0/d/'.$presentation_id.'=w200-h150-p-k-nu-iv1';
        $provider_id = User::Select('provider_id')->Where('g_username', $gusermail)->first()->toArray();

        $presentation_name = sha1($provider_id['provider_id'].$presentation_id.$title);


        $presentation_data = new Presentation();
        $presentation_data->provider_id = $provider_id['provider_id'];
        $presentation_data->title = $title;
        $presentation_data->presentation_name = $presentation_name;
        $presentation_data->presentation_id = $presentation_id;
        $presentation_data->presentation_url = $presentation_url;
        $presentation_data->thumbnail_url = $thumbnail_url;
        $presentation_data->save();

        Session::flash("success","$title Uploaded");
        return redirect(route('presentations', ['gusermail' => $gusermail ]));
    }
}
