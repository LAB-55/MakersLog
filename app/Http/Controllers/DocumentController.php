<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Helpers\Meta;
use App\User;
use App\Document;
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

class DocumentController extends Controller
{
    public function documents($gusermail) {
        if(Auth::check() &&  Auth::user()->g_username == $gusermail ) {
        	$provider_id = User::Select('provider_id')
        							->Where('g_username', $gusermail)
        							->first()->toArray();
			$documents = Document::Select('*')
									->Where('provider_id', $provider_id['provider_id'])
									->get();
            return view('documents')
            		->with('documents', $documents)
            		->with('meta',Meta::get());
        }
        else {
            return redirect(route('gusermail', ['gusermail' => $gusermail]));
        }
    }

    public function documentView($gusermail, $googledrive_id) {
    	if(Auth::check() &&  Auth::user()->g_username == $gusermail ) {
        	$provider_id = User::Select('provider_id')
        							->Where('g_username', $gusermail)
        							->first()->toArray();
			$document = Document::Select('*')
											->Where('provider_id', $provider_id['provider_id'])
											->Where('googledrive_id', $googledrive_id)
											->first()->toArray();
            return view('document_view')
            		->with('document', $document)
            		->with('meta',Meta::get());
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

    public function uploadDocuments(Request $request, $gusermail) {
        
        $file = Input::file('documents');
        $extension = $file->extension();
        // dd($extension);
        $filename = $file->getClientOriginalName();
        // $filename = pathinfo($fullfilename, PATHINFO_FILENAME);
        // $extension = pathinfo($fullfilename, PATHINFO_EXTENSION);
        
        if(	$extension == "pptx" || $extension == "ppt" || 
        	$extension == "xlsx" || $extension == "xls" || 
        	$extension == "docx" || $extension == "doc" || 
        	$extension == "txt" ) {

	        $file->move(public_path().'/documents', $filename);
	        
	        $content = file_get_contents(public_path().'/documents/'.$filename);
            
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
 			
 			if ( $extension == "pptx" || $extension == "ppt" ) {
	 			$fileMetadata = new Google_Service_Drive_DriveFile(array(
	              'name' => $filename,
	              'mimeType' => 'application/vnd.google-apps.presentation',
	              'parents' => array($folderId)
	            ));
	            $forUrl = "presentation";
 			}

 			elseif ( $extension == "xlsx" || $extension == "xls" ) {
	 			$fileMetadata = new Google_Service_Drive_DriveFile(array(
	              'name' => $filename,
	              'mimeType' => 'application/vnd.google-apps.spreadsheet',
	              'parents' => array($folderId)
	            ));
	            $forUrl = "spreadsheets";
 			}

 			else {
 				$fileMetadata = new Google_Service_Drive_DriveFile(array(
	              'name' => $filename,
	              'mimeType' => 'application/vnd.google-apps.document',
	              'parents' => array($folderId)
	            ));
	         	$forUrl = "document";   
 			}

            // dd($fileMetadata);
            $googledrive = $service->files->create($fileMetadata, array(
              'data' => $content,
              'uploadType' => 'multipart',
              'fields' => 'id')
            );
            //dd($googledrive);

            $googledrive_id = $googledrive->id;

            if ( $forUrl == "presentation" ) {
				$googledrive_url = 'https://docs.google.com/presentation/d/'.$googledrive_id.'/embed?start=false&loop=false&delayms=3000';
 			}

 			elseif ( $forUrl == "spreadsheets" ) {
				$googledrive_url = 'https://docs.google.com/spreadsheets/d/'.$googledrive_id.'/pubhtml?widget=true&amp;headers=false';
 			}

 			else {
				$googledrive_url = 'https://docs.google.com/document/d/'.$googledrive_id.'/pub?embedded=true';
 			}

            $thumbnail_url = 'https://lh3.google.com/u/0/d/'.$googledrive_id.'=w200-h150-p-k-nu-iv1';
            $provider_id = User::Select('provider_id')->Where('g_username', $gusermail)->first()->toArray();

            // $presentation_name = sha1($provider_id['provider_id'].$presentation_id.$filename);


            $document_data = new Document();
            $document_data->provider_id = $provider_id['provider_id'];
            // $document_data->p_id = ;
            // $document_data->document_id = ;
            $document_data->document_name = $filename;
            $document_data->googledrive_id = $googledrive_id;
            $document_data->googledrive_url = $googledrive_url;
            $document_data->thumbnail_url = $thumbnail_url;
            $document_data->save();
            Session::flash("success","$filename Uploaded");
        }
        else {
        	Session::flash("error","File is not Supported.");	
        }
        
        // return redirect(route('presentations', ['gusermail' => $gusermail ]));
    }
}
