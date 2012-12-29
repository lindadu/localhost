<?php
    // configure
    require("../includes/config.php");
    
    // get start and end of desired time range from event request
    $stime = query("SELECT start_time FROM events WHERE `request id` =?",$_SESSION["request_id"])[0]["start_time"];
    $etime = query("SELECT end_time FROM events WHERE `request id` =?", $_SESSION["request_id"])[0]["end_time"];
    $stime = new DateTime($stime);
    $etime = new DateTime($etime);
   
    // get start and end of desired date range from event request
    $sdate = query("SELECT start_date FROM events WHERE `request id` =?",$_SESSION["request_id"])[0]["start_date"];
    $edate = query("SELECT end_date FROM events WHERE `request id` =?",$_SESSION["request_id"])[0]["end_date"];
    $sdate = new DateTime($sdate);
    $edate = new DateTime($edate);

    // get desired duration of event
    $duration = query("SELECT duration FROM events WHERE `request id` =?",$_SESSION["request_id"])[0]["duration"];
    
    // calculate the latest possible start time by taking into account the duration of the event
    $etime->sub(new DateInterval('PT'.(string)$duration.'H'));
 
    // get information of user who sent the request
    $friendemail = query("SELECT `user 1` FROM events WHERE `request id`=?",$_SESSION["request_id"])[0]["user 1"];
    $friendid = query("SELECT id FROM users WHERE username=?",$friendemail)[0]["id"];


    $results = array(); 
    // yay algorithm! iterates over relevant date and time ranges
    while ($sdate <= $edate)
    {    
        while ($stime <= $etime)
        {
            // find the first mutual free time that matches the parameters
            if (notBusy($_SESSION["id"],$stime,$sdate,$duration) && notBusy($friendid,$stime,$sdate,$duration))
            {
                $start_time = $stime->format('H:i');
                $start_date = $sdate->format('Y-m-d');
                
                //get all event information to pass to insert function
                $result = query("SELECT name, description FROM events WHERE `request id` = ?", $_SESSION["request_id"]);
                // store all information into session variables to pass to insert.php
                $result["start_date"] = $start_date;
                $result["end_date"] = $start_date;
                $result["start_time"] = $start_time;
                
                $etime = $stime->add(new DateInterval('PT'.$duration.'H'));
                $end_time = $etime->format('H:i');
                
                $result["end_time"] = $end_time;
                $results[] = $result;
            }
            
            // if one or more of the user(s) are busy, check the next half hour interval
            $stime->add(new DateInterval('PT30M'));
        }
        
        // if all times in day are not mutually free, check the next day
        $sdate->add(new DateInterval('P1D'));
        
        // reset start and end times for the new day to check
        $stime = query("SELECT start_time FROM events WHERE `request id` =?",$_SESSION["request_id"])[0]["start_time"];
        $etime = query("SELECT end_time FROM events WHERE `request id` =?", $_SESSION["request_id"])[0]["end_time"];
    
        $stime = new DateTime($stime);
        $etime = new DateTime($etime);
    }
    if (count($results) != 0)
    {
        $_SESSION["results"] = $results;
        redirect("insert.php");    
    }
    else
        render("sorry.php", ["title" => "sorry!"]);
    
    /*
     * notBusy returns true when the user is free, false when busy.
     */
    function notBusy($user,$s,$d,$l)
    {
        $date = $d->format('Y-m-d');
      
        // query database for the stored busy times of the user
        $events = query("SELECT start_date, end_date, busy_start_time, busy_end_time FROM requests WHERE `request_id` =? AND id=? AND start_date =?", $_SESSION["request_id"], $user,$date);
        
        foreach ($events as $event)
        {
            $end = clone $s;
            
            // calculate end time
            $end->add(new DateInterval('PT' . $l . 'H'));
            $bst = new DateTime($event["busy_start_time"]);
            $bse = new DateTime($event["busy_end_time"]);
            
            // checks if busy times conflict with the time interval currently being checked
            if ($bst <= $s && $bse > $s)
            {
                return false;
            }
            else if ($bst >= $s && $bst < $end)
                return false;
        }
        return true;   
    }
?>
