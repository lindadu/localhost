<?php
// code adapted from google api php client library
// configuration
//require("../includes/config.php"); 

 // load classes

  require_once 'Zend/Loader.php';
  require_once 'Zend/Gdata/AuthSub.php';

  Zend_Loader::loadClass('Zend_Gdata');

  Zend_Loader::loadClass('Zend_Gdata_ClientLogin');

  Zend_Loader::loadClass('Zend_Gdata_Calendar');

  Zend_Loader::loadClass('Zend_Http_Client');
  
  // Create an authenticated HTTP Client to talk to Google.
$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
$client = Zend_Gdata_AuthSub::getHttpClient($_SESSION['cal_token']);
 
// Create a Gdata object using the authenticated Http Client
$service = new Zend_Gdata_Calendar($client);

//session_start();

/*$client = new Google_Client();
$client->setApplicationName("Google Calendar Application");

// configure client
$client->setClientId('489378907359.apps.googleusercontent.com');
$client->setClientSecret('jLH3xCVk7u1TrZDKdho3zkwM');
$client->setRedirectUri('http://localhost/text.php');
$client->setDeveloperKey('AIzaSyDTn1mc6RFV0jMTEgRhjcfRufEm7Y-qvQ8');
$cal = new Google_CalendarService($client); 

// if logout, "forget" access token
if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}

// authenticate authorization code and get access token
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if (!$client->getAccessToken()) {
  //$calList = $cal->calendarList->listCalendarList();
  //print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";
  //print $_SESSION['token'];*/
  

  
  // Create a new entry using the calendar service's magic factory method
$event= $service->newEventEntry();
 
// Populate the event with the desired information
// Note that each attribute is crated as an instance of a matching class
$event->title = $service->newTitle("My Event");
$event->where = array($service->newWhere("Mountain View, California"));
$event->content =
    $service->newContent(" This is my awesome event. RSVP required.");
 
// Set the date using RFC 3339 format.
$startDate = "2012-12-07";
$startTime = "14:00";
$endDate = "2012-12-07";
$endTime = "16:00";
$tzOffset = "-08";
 
$when = $service->newWhen();
$when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:00";
$when->endTime = "{$endDate}T{$endTime}:00.000{$tzOffset}:00";
$event->when = array($when);
 
// Upload the event to the calendar server
// A copy of the event as it is recorded on the server is returned
$newEvent = $service->insertEvent($event);

//$_SESSION['token'] = $client->getAccessToken();
//} 

/* if no access token, create new authorization url
else {
   // redirect("auth.php");
}*/
        
    // redirect to create an event page
    //redirect("event.php");

?>
