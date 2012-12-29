<?php
/***********************************************************************
     * insert.php
     *
     * Computer Science 50
     * meetr
     * Linda Du, Dean Shu, and Kevin Jiang
     *
     * Inserts the first mutually free time and creates the event in user's
     * Google Calendar.
     *
     * Adapted from Zend Framwork Example Code
     **********************************************************************/

    // load classes
        require("../includes/config.php");
      require_once 'Zend/Loader.php';
      require_once 'Zend/Gdata/HttpClient.php';
      require_once 'Zend/Gdata/AuthSub.php';

      Zend_Loader::loadClass('Zend_Gdata');

      Zend_Loader::loadClass('Zend_Gdata_ClientLogin');

      Zend_Loader::loadClass('Zend_Gdata_Calendar');

      Zend_Loader::loadClass('Zend_Http_Client');
      
    $my_calendar = 'http://www.google.com/calendar/feeds/default/private/full';
     
    if (!isset($_SESSION['cal_token'])) {
        if (isset($_GET['token'])) {
            // You can convert the single-use token to a session token.
            $session_token =
                Zend_Gdata_AuthSub::getAuthSubSessionToken($_GET['token']);
            // Store the session token in our session.
            $_SESSION['cal_token'] = $session_token;
        } else {
            // display link to generate single-use token
            $googleUri = Zend_Gdata_AuthSub::getAuthSubTokenUri(
            'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'],
            $my_calendar, 0, 1);
        
            // format the page     
           echo "<link href=\"../css/bootstrap.css\" rel=\"stylesheet\">";
            echo "<style type=\"text/css\"> body { padding-top: 60px; padding-bottom: 40px; }";
           echo "</style><link href=\"../css/bootstrap-responsive.css\" rel=\"stylesheet\">";
           
           echo "<div class=\"container\">";

      echo "<body><div class=\"hero-unit\">";
        echo "</br></br></br>";
        echo "<p>Connect your platform of</br>choice. <strong>Any platform.</strong> </p>
        </br>";
        
        echo "<p>";

        
        echo "Click <a href='$googleUri'>here</a> " .
             "to authorize meetr.";
        echo "</p></div></body>";
        
        exit();
        }
    }

    // create an authenticated HTTP Client to talk to Google.
    $client = Zend_Gdata_AuthSub::getHttpClient($_SESSION['cal_token']);
     
    // create a Gdata object using the authenticated Http Client
    $service = new Zend_Gdata_Calendar($client);

    // create a new entry using the calendar service's magic factory method
    $event= $service->newEventEntry();
     
    // create the event title
    $event->title = $service->newTitle($_SESSION["event_name"]);
    //$event->where = array($service->newWhere(""));
    if(isset($_SESSION["description"]))
        $event->content = $service->newContent($_SESSION["description"]);

    // set the date using RFC 3339 format.
    $startDate = $_SESSION["start_date"];
    $startTime = $_SESSION["start_time"];
    $endDate = $_SESSION["end_date"];
    $endTime = $_SESSION["end_time"];
    
    // sets the timezone to eastern standard time
    $tzOffset = "-05";
     
    $when = $service->newWhen();
    $when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:00";
    $when->endTime = "{$endDate}T{$endTime}:00.000{$tzOffset}:00";
    $event->when = array($when);
     
    // upload the event to the calendar server
    $newEvent = $service->insertEvent($event);

    //render the display notifying user of event creation
    render("display.php", ["title" => "success!", "event_name" => $_SESSION["event_name"], "event_date" => $startDate, "start_time" => $startTime, "end_time" => $endTime]);
?>
