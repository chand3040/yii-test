<?php
// Call set_include_path() as needed to point to your client library.
require_once realpath(dirname(__FILE__) . '/Google/autoload.php');

define('OAUTH2_CLIENT_ID', '807397577789-mdi14842gb67va4mrors2hds1l7ehmt8.apps.googleusercontent.com');
define('OAUTH2_CLIENT_SECRET', '0gFv1dT5DL0I4g-R5Coc-YMo');

class YoutubeUpload {
  /*
   * You can acquire an OAuth 2.0 client ID and client secret from the
   * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
   * For more information about using OAuth 2.0 to access Google APIs, please see:
   * <https://developers.google.com/youtube/v3/guides/authentication>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */

  public $OAUTH2_CLIENT_ID;
  public $OAUTH2_CLIENT_SECRET;
  public $client;
  // Define an object that will be used to make all API requests.
  public $youtube;

  public function init() {
    $this->OAUTH2_CLIENT_ID = OAUTH2_CLIENT_ID;
    $this->OAUTH2_CLIENT_SECRET = OAUTH2_CLIENT_SECRET;

    $this->client = new Google_Client();
    $this->client->setClientId($this->OAUTH2_CLIENT_ID);
    $this->client->setClientSecret($this->OAUTH2_CLIENT_SECRET);
    $this->client->setScopes('https://www.googleapis.com/auth/youtube');
    //set offine access to get refresh token
    $this->client->setAccessType('offline');
    $this->client->setApprovalPrompt('force');

    $this->youtube = new Google_Service_YouTube($this->client);
    //get access token and refresh token from token file
    $txtToken = @file_get_contents(dirname(__FILE__) . "/token.txt");
    if (!$txtToken) {
      exit();
    }
    //get token from file
    $tokens = json_decode($txtToken, true);
    if (!$tokens || !isset($tokens['accessToken']) || !isset($tokens['refreshToken'])) {
      //wrong json format
      exit();
    }

    //update client
    $this->client->setAccessToken($tokens['accessToken']);
    $this->client->refreshToken($tokens['refreshToken']);
    //wrong access token or changed refresh token
    if (!$this->client->getAccessToken()) {
      exit();
    }
    //renew access token
    $this->client->setAccessToken($tokens['accessToken']);
    //write to disk
    file_put_contents(dirname(__FILE__) . '/token.txt', json_encode(array(
        'accessToken' => $this->client->getAccessToken(),
        'refreshToken' => $this->client->getRefreshToken()
    )));
  }

  public function run() {
    $this->init();

    //TODO - check upload file in db
    $file = dirname(__FILE__) . "/FunnyMinions.mp4";
    $this->upload($file, 'MINIONS Funny');
  }

  public function upload($videoPath, $title, $description = '', $tags = array()) {
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
      
      //save status to DB
      
    } catch (Google_Service_Exception $e) {
      exit();
    }
  }

}

$a = new YoutubeUpload();
$a->run();