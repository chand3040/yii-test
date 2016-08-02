<?php
require_once dirname(__FILE__) . '/../extensions/youtube/Google/autoload.php';
define('OAUTH2_CLIENT_ID', '544706165083-f9r444i3k6t8j2s014q8k22a6p5en4ck.apps.googleusercontent.com');
define('OAUTH2_CLIENT_SECRET', '_nZCvHVN9TQpqar-RwXU8cK1');
define('OAUTH2_CLIENT_REDIRECT', Yii::app()->getBaseUrl(true) . '/admin/listings/listings/updateToken');


class UploadYoutube {

    protected $client;
    protected $youtube;

    public function __construct() {
        $this->client = new Google_Client();
        $this->client->setClientId(OAUTH2_CLIENT_ID);
        $this->client->setClientSecret(OAUTH2_CLIENT_SECRET);
        $this->client->setScopes('https://www.googleapis.com/auth/youtube');
//set offine access to get refresh token
        $this->client->setAccessType('offline');
        $this->client->setApprovalPrompt('force');
        $this->client->setRedirectUri(OAUTH2_CLIENT_REDIRECT);
        $state = mt_rand();
        $this->client->setState($state);
        $_SESSION['state'] = $state;
        
        
    }

    public function getRedirect() {
        return $this->client->createAuthUrl();
    }

    public function writeAccesstoken() {
        if (isset($_GET['code'])) {
            $this->client->authenticate($_GET['code']);
            $_SESSION['token'] = $this->client->getAccessToken();
            header('Location: ' . $redirect);
        }
        if (isset($_SESSION['token'])) {
            $this->client->setAccessToken($_SESSION['token']);
        }

// Check to ensure that the access token was successfully acquired.
        if ($this->client->getAccessToken()) {
//write access token & refresh token to txtfile
            $tokens = json_encode(array(
                'accessToken' => $this->client->getAccessToken(),
                'refreshToken' => $this->client->getRefreshToken()
            ));

            file_put_contents(dirname(__FILE__) . '/../extensions/youtube/token.txt', $tokens);
        }
    }

    public function setTokenClient() {
        $this->youtube = new Google_Service_YouTube($this->client);
        $txtToken = @file_get_contents(dirname(__FILE__) . '/../extensions/youtube/token.txt');
        if (!$txtToken) {
            echo json_encode(array('message'=>"Unauthorized client,Please Click on Change access token link "));
            exit();
        }
        //get token from file
        $tokens = json_decode($txtToken, true);
        if (!$tokens || !isset($tokens['accessToken']) || !isset($tokens['refreshToken'])) {
            //wrong json format
             echo json_encode(array('message'=>"Unauthorized client,Please Click on Change access token link "));
            exit();
        }

        //update client
        $this->client->setAccessToken($tokens['accessToken']);
        $this->client->refreshToken($tokens['refreshToken']);
        //wrong access token or changed refresh token
        if (!$this->client->getAccessToken()) {
              echo json_encode(array('message'=>"Unauthorized client"));
         
             exit();
        }
        //renew access token
        $this->client->setAccessToken($tokens['accessToken']);
        //write to disk
        file_put_contents(dirname(__FILE__) . '/../extensions/youtube/token.txt', json_encode(array(
            'accessToken' => $this->client->getAccessToken(),
            'refreshToken' => $this->client->getRefreshToken()
        )));
    }

    public function upload($videoPath, $title, $description = '', $tags = array()) {
        $this->setTokenClient();
        try {
			
// Create a snippet with title, description, tags and category ID
// Create an asset resource and set its snippet metadata and type.
// This example sets the video's title, description, keyword tags, and
// video category.
            $snippet = new Google_Service_YouTube_VideoSnippet();
            $snippet->setTitle($title);
            $snippet->setDescription($description);
            $snippet->setTags($tags);
// Numeric video category. See
// https://developers.google.com/youtube/v3/docs/videoCategories/list 
            $snippet->setCategoryId("22");
			
// Set the video's status to "public". Valid statuses are "public",
// "private" and "unlisted".
            $status = new Google_Service_YouTube_VideoStatus();
            $status->privacyStatus = "public";
// Associate the snippet and status objects with a new video resource.
            $video = new Google_Service_YouTube_Video();
            $video->setSnippet($snippet);
            $video->setStatus($status);
			
// Specify the size of each chunk of data, in bytes. Set a higher value for
// reliable connection as fewer chunks lead to faster uploads. Set a lower
// value for better recovery on less reliable connections.
            $chunkSizeBytes = 1 * 1024 * 1024;

// Setting the defer flag to true tells the client to return a request which can be called
// with ->execute(); instead of making the API call immediately.
            $this->client->setDefer(true);
// Create a request for the API's videos.insert method to create and upload the video.
            $insertRequest = $this->youtube->videos->insert("status,snippet", $video);

// Create a MediaFileUpload object for resumable uploads.
            $media = new Google_Http_MediaFileUpload(
                    $this->client, $insertRequest, 'video/*', null, true, $chunkSizeBytes
            );
            $media->setFileSize(filesize($videoPath));

// Read the media file and upload it chunk by chunk.
            $chunkStatus = false;
            $handle = fopen($videoPath, "rb");
			
            while (!$chunkStatus && !feof($handle)) {
                $chunk = fread($handle, $chunkSizeBytes);
				
                $chunkStatus = $media->nextChunk($chunk);
				
                
            }
			
            fclose($handle);
	
// If you want to make other calls after the file upload, set setDefer back to false
            $this->client->setDefer(false);
            echo json_encode(array('id'=>$chunkStatus->id,'status'=>'success'));
//save status to DB
        } catch (Google_Service_Exception $e) {
            // var_dump($e);
              echo json_encode(array('message'=>$e->getMessage()));
            exit();
        }
    }

}