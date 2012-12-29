<?php
/***********************************************************************
     * access.php
     *
     * Computer Science 50
     * meetr
     * Linda Du, Dean Shu, Kevin Jiang
     *
     * Retrieves an access token for authorization and queries for all busy
     * times within apropriate date range.
     *
     * Code adapted from Zend Framework Example Code
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
  
    // if a request id is passed via a form, we know that user is accepting a request so we store correct request id
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $_SESSION["request_id"] = $_POST["accrequestid"];
    }
  
    // define calendar
    $my_calendar = 'http://www.google.com/calendar/feeds/default/private/full';
 
    if (!isset($_SESSION['cal_token'])) 
    {
        if (isset($_GET['token'])) {
            // convert the single-use token to a session token.
            $session_token =
            Zend_Gdata_AuthSub::getAuthSubSessionToken($_GET['token']);
            // store the session token in our session.
            $_SESSION['cal_token'] = $session_token;
    } 
    else 
    { 
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

    // find the query parameters start date and end date
    $sresult = query("SELECT `start_date` FROM events WHERE `request id` = ?",$_SESSION["request_id"]);
    $start_date = $sresult[0]['start_date'];
    $eresult = query("SELECT `end_date` FROM events WHERE `request id` = ?", $_SESSION["request_id"]); 
    $end_date = $eresult[0]['end_date'];
    $end_date = new DateTime($end_date);
    $end_date->add(new DateInterval('P1D'));
    $end_date = $end_date->format('Y-m-d');

    $query = $service->newEventQuery();
    $query->setUser('default');
    
    // set to $query->setVisibility('private-magicCookieValue') if using MagicCookie auth
    $query->setVisibility('private');
    $query->setProjection('full');
    $query->setOrderby('starttime');
    $query->setStartMin($start_date);
    $query->setStartMax($end_date);
     
    // retrieve the event list from the calendar server
    try {
        $eventFeed = $service->getCalendarEventFeed($query);
    } catch (Zend_Gdata_App_Exception $e) {
        echo "Error: " . $e->getMessage();
    }
     
    // iterate through the list of events, inputting busy times into database
    foreach ($eventFeed as $event) {

        $when = $event->getWhen();
        $sdate_time = new DateTime($when[0]->getStartTime());
        $edate_time = new DateTime($when[0]->getEndTime());

        $start_date = $sdate_time->format('Y-m-d');
        $start_time = $sdate_time->format('H:i');
        $end_date = $edate_time->format('Y-m-d');
        $end_time = $edate_time->format('H:i');
        
        // insert into SQL database
        $result = query("INSERT INTO requests (request_id, busy_start_time, busy_end_time, start_date, end_date, id) VALUES(?, ?, ?, ?, ?, ?)",
                $_SESSION["request_id"], $start_time, $end_time, $start_date, $end_date, $_SESSION["id"]);   
    }

    $result = query("SELECT id FROM events WHERE `request id` = ?", $_SESSION["request_id"]);
    $sender_id = $result[0]['id'];

    // if user is sending a request, just redirect to inbox
    if ($sender_id === $_SESSION["id"])
    {
        redirect("index.php");
    }
    
    // if user is receiving/accepting the request, need to compare busy times of the two users
    else
    {
        redirect("compare.php");
    }

?>
