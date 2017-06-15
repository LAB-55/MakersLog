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
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;

define('APPLICATION_NAME', 'MakersLog');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
define('SCOPES', implode(' ', array(
  Google_Service_Drive::DRIVE_METADATA_READONLY)
));

class PresentationController extends Controller
{
    public function presentations($gusermail) {
        if(Auth::check() &&  Auth::user()->g_username == $gusermail ) {
        	$provider_id = User::Select('provider_id')
        							->Where('g_username', $gusermail)
        							->first()->toArray();
			$presentations = Presentation::Select('*')
									->Where('provider_id', $provider_id['provider_id'])
									->get();
            return view('presentations')
            		->with('presentations', $presentations)
            		->with('meta',Meta::get('Kalpit Akhawat / New Log'));
        }
        else {
            return redirect(route('gusermail', ['gusermail' => $gusermail]));
        }
    }

    public function presentationView($gusermail, $presentation_id) {
    	if(Auth::check() &&  Auth::user()->g_username == $gusermail ) {
        	$provider_id = User::Select('provider_id')
        							->Where('g_username', $gusermail)
        							->first()->toArray();
			$presentation = Presentation::Select('*')
											->Where('provider_id', $provider_id['provider_id'])
											->Where('presentation_id', $presentation_id)
											->first()->toArray();
            return view('presentation_view')
            		->with('presentation', $presentation)
            		->with('meta',Meta::get('Kalpit Akhawat / New Log'));
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
        $file = Input::file('ppt');
        $extension = $file->extension();
        $filename = $file->getClientOriginalName();
        
        $file->move(public_path().'/presentation', $filename);
        
        $content = file_get_contents(public_path().'/presentation/'.$filename);

        $client = $this->getClient();
        $service = new Google_Service_Drive($client);

        /* Create folder in Drive */

        // $fileMetadata = new Google_Service_Drive_DriveFile(array(
        //                     'name' => 'Invoices',
        //                     'mimeType' => 'application/vnd.google-apps.folder'));
        // $folder = $service->files->create($fileMetadata, array(
        //                     'fields' => 'id'));
        // printf("Folder ID: %s\n", $folder->id);
        // exit();

        /* Create folder in Drive */

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

        $presentation_name = sha1($provider_id['provider_id'].$presentation_id.$filename);


        $presentation_data = new Presentation();
        $presentation_data->provider_id = $provider_id['provider_id'];
        $presentation_data->title = $filename;
        $presentation_data->presentation_name = $presentation_name;
        $presentation_data->presentation_id = $presentation_id;
        $presentation_data->presentation_url = $presentation_url;
        $presentation_data->thumbnail_url = $thumbnail_url;
        $presentation_data->save();

        Session::flash("success","$filename Uploaded");
        return redirect(route('presentations', ['gusermail' => $gusermail ]));
    }
}
