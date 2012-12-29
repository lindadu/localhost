<?php
/* configuration
    require("../includes/config.php");

//adapted from http://www.jensbits.com/2011/12/20/authenticating-with-oauth-2-0-for-google-api-access-with-php/
$client_id = "489378907359.apps.googleusercontent.com"; //your client id
$client_secret = "jLH3xCVk7u1TrZDKdho3zkwM"; //your client secret
$redirect_uri = "http://localhost/OAuth.php"; //redirect uri
$scope = "https://www.googleapis.com/auth/calendar";
//$scope = "https://www.google.com/calendar/feeds/"; //google scope to access
$state = "profile"; //optional
$access_type = "offline"; //optional - allows for retrieval of refresh_token for offline access
//so session vars can be used
session_start(); 

<?php*/
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_PlusService.php';

// Set your cached access token. Remember to replace $_SESSION with a
// real database or memcached.
session_start();

$client = new Google_Client();
$client->setApplicationName('Google+ PHP Starter Application');
// Visit https://code.google.com/apis/console?api=plus to generate your
// client id, client secret, and to register your redirect uri.
$client->setClientId('489378907359.apps.googleusercontent.com');
$client->setClientSecret('jLH3xCVk7u1TrZDKdho3zkwM');
$client->setRedirectUri('http://localhost/');
$client->setDeveloperKey('AIzaSyDTn1mc6RFV0jMTEgRhjcfRufEm7Y-qvQ8');
$plus = new Google_PlusService($client);

if (isset($_GET['code'])) {
  $client->authenticate();
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
  $activities = $plus->activities->listActivities('me', 'public');
  print 'Your Activities: <pre>' . print_r($activities, true) . '</pre>';

  // We're not done yet. Remember to update the cached access token.
  // Remember to replace $_SESSION with a real database or memcached.
  $_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a href='$authUrl'>Connect Me!</a>";
}

/*Oauth 2.0: exchange token for session token so multiple calls can be made to api
if(isset($_REQUEST['code'])){
	$_SESSION['accessToken'] = get_oauth2_token($_REQUEST['code']);
}
else {
    echo("NO AUTHORIZATION CODE");
}

//returns session token for calls to API using oauth 2.0
function get_oauth2_token($code) {
	global $client_id;
	global $client_secret;
	global $redirect_uri;
	
	$oauth2token_url = "https://accounts.google.com/o/oauth2/token";
	$clienttoken_post = array(
	"code" => $code,
	"client_id" => $client_id,
	"client_secret" => $client_secret,
	"redirect_uri" => $redirect_uri,
	"grant_type" => "authorization_code"
	);
	
	$curl = curl_init($oauth2token_url);

	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	$json_response = curl_exec($curl);
	curl_close($curl);

	$authObj = json_decode($json_response);
	
	if (isset($authObj->refresh_token)){
		global $refreshToken;
		$refreshToken = $authObj->refresh_token;
	}

	$accessToken = $authObj->access_token;
	return $accessToken;
}
$loginUrl = sprintf("https://accounts.google.com/o/oauth2/auth?scope=%s&state=%s&redirect_uri=%s&response_type=code&client_id=%s",$scope,$state,$redirect_uri,$client_id);
redirect("index.php"); */

?> 
