<?php 
$client_id = "489378907359.apps.googleusercontent.com"; //your client id
$client_secret = "jLH3xCVk7u1TrZDKdho3zkwM"; //your client secret
$redirect_uri = "http://localhost/"; //CHANGE LATER
$scope = "https://www.googleapis.com/auth/calendar"; //google scope to access
$state = "profile"; //optional
$access_type = "offline"; //optional - allows for retrieval of refresh_token for offline access

$loginUrl = sprintf("https://accounts.google.com/o/oauth2/auth?scope=%s&state=%s&redirect_uri=%s&response_type=code&client_id=%s&access_type=%s", $scope, $state, $redirect_uri, $client_id, $access_type);


//Oauth 2.0: exchange token for session token so multiple calls can be made to api
if(isset($_REQUEST['code'])){
	$_SESSION['accessToken'] = get_oauth2_token($_REQUEST['code']);
}
else {
echo("NO REQUEST CODE");}

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
//calls api and gets the data
function call_api($accessToken,$url){
	$curl = curl_init($url);
 
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);	
	$curlheader[0] = "Authorization: Bearer " . $accessToken;
	curl_setopt($curl, CURLOPT_HTTPHEADER, $curlheader);

	$json_response = curl_exec($curl);
	curl_close($curl);
		
	$responseObj = json_decode($json_response);
	return $responseObj;	    
}

$loginUrl = sprintf("https://accounts.google.com/o/oauth2/auth?scope=%s&state=%s&redirect_uri=%s&response_type=code&client_id=%s",$scope,$state,$redirect_uri,$client_id);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>meetr</title>
<link rel="stylesheet" type="text/css" href="css/960.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
</head>

<body>
<div id="wrapper">
	
	<div id="header" class="container_16">
		<h1>meetr</h1>
	</div>
    
<div id="content-wrap" class="container_16">   
<div class="grid_8 prefix_4 suffix_4"> 
	<p><a class="button" href="<?php echo $loginUrl ?>">Grant access with Google account for basic user info</a></p>
    
 <?php
	if (isset($_SESSION['accessToken'])){
		$accountObj = call_api($_SESSION['accessToken'],"https://www.googleapis.com/oauth2/v1/userinfo");
		$your_name =  $accountObj->name;
		echo "<p class='successMessage'>The name on your Google account is: " . $your_name . "</p>";
		//session_unset();
	}
	if(isset($_REQUEST['error'])){
		echo "<p class='errorMessage'>Error: " . $_REQUEST['error'] . "</p>";
	}
?> 
</div>   
</div>
</div>
</body>
</html>
