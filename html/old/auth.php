<?php
// code adapted from google api php client library
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_CalendarService.php';

$client = new Google_Client();
$client->setApplicationName("Google Calendar PHP Starter Application");

// configure client
$client->setClientId('489378907359.apps.googleusercontent.com');
$client->setClientSecret('jLH3xCVk7u1TrZDKdho3zkwM');
$client->setRedirectUri('http://localhost/text.php');
$client->setDeveloperKey('AIzaSyDTn1mc6RFV0jMTEgRhjcfRufEm7Y-qvQ8');
$cal = new Google_CalendarService($client);

$authUrl = $client->createAuthUrl();
print "<a class='login' href='$authUrl'>Connect Me!</a>";
?>

