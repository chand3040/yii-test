<?php
// Call set_include_path() as needed to point to your client library.
require_once realpath(dirname(__FILE__) . '/Google/autoload.php');
session_start();
/*
 * You can acquire an OAuth 2.0 client ID and client secret from the
 * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
 * For more information about using OAuth 2.0 to access Google APIs, please see:
 * <https://developers.google.com/youtube/v3/guides/authentication>
 * Please ensure that you have enabled the YouTube Data API for your project.
 */
$OAUTH2_CLIENT_ID = '807397577789-mdi14842gb67va4mrors2hds1l7ehmt8.apps.googleusercontent.com';
$OAUTH2_CLIENT_SECRET = '0gFv1dT5DL0I4g-R5Coc-YMo';
$client = new Google_Client();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setClientSecret($OAUTH2_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube');
//set offine access to get refresh token
$client->setAccessType('offline');
$client->setApprovalPrompt('force');
$redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], FILTER_SANITIZE_URL);

$client->setRedirectUri($redirect);
// Define an object that will be used to make all API requests.
$youtube = new Google_Service_YouTube($client);
if (isset($_GET['code'])) {  
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: ' . $redirect);
}
if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

// Check to ensure that the access token was successfully acquired.
if ($client->getAccessToken()) {
  //write access token & refresh token to txtfile
  $tokens = json_encode(array(
      'accessToken' => $client->getAccessToken(),
      'refreshToken' => $client->getRefreshToken()
  ));
  
  file_put_contents('token.txt', $tokens);
  $authUrl = $client->createAuthUrl();
  $htmlBody = <<<END
  <h3>Success, you has been verified your account.</h3>
  <p>If you want to change token please click <a href="$authUrl">authorize access</a> or close browser.<p>
END;
} else {
// If the user hasn't authorized the app, initiate the OAuth flow
  $state = mt_rand();
  $client->setState($state);
  $_SESSION['state'] = $state;
  $authUrl = $client->createAuthUrl();
  $htmlBody = <<<END
  <h3>Authorization Required</h3>
  <p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
END;
}
?>

<!doctype html>
<html>
  <head>
    <title>Verify youtube oauth token</title>
  </head>
  <body>
    <?= $htmlBody ?>
  </body>
</html>