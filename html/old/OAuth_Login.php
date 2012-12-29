<?php
//code from http://www.jensbits.com/2011/12/20/authenticating-with-oauth-2-0-for-google-api-access-with-php/

$client_id = "489378907359.apps.googleusercontent.com"; //your client id
$client_secret = "jLH3xCVk7u1TrZDKdho3zkwM"; //your client secret
$redirect_uri = "http://localhost/"; //CHANGE LATER
$scope = "https://www.googleapis.com/auth/calendar";
//$scope = "https://www.google.com/calendar/feeds/"; //google scope to access
$state = "profile"; //optional
$access_type = "offline"; //optional - allows for retrieval of refresh_token for offline access

$loginUrl = sprintf("https://accounts.google.com/o/oauth2/auth?scope=%s&state=%s&redirect_uri=%s&response_type=code&client_id=%s&access_type=%s", $scope, $state, $redirect_uri, $client_id, $access_type);
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
    
 
</div>   
</div>
</div>
</body>
</html>
