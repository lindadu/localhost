<?php
 
/***********************************************************************
     * event.php
     *
     * Computer Science 50
     * meetr
     * Linda Du, Dean Shu, and Kevin Jiang
     *
     * Allows user to create a new event.
     **********************************************************************/
 
 
    // configuration
    require("../includes/config.php");
    require_once 'google-api-php-client/src/Google_Client.php';
    require_once 'google-api-php-client/src/contrib/Google_CalendarService.php';
    //require_once 'google-api-php-client/src/contrib/Google_PlusService.php';
 
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // check that user entered event name
        if (empty($_POST["name"]))
        {
            apologize("You did not enter a name for the event.");
        }
        
        // check that user entered event duration
        if (empty($_POST["duration"]))
        {
            apologize("You did not enter a duration for the event.");
        }
        
        // check that user entered start/end time
        if (empty($_POST["start_time"]) || empty($_POST["end_time"]))
        {
            apologize("You did not enter a start and/or end time for the preferred time range.");
        }
        
        // check that user entered start/end date
        if (empty($_POST["start_date"]) || empty($_POST["end_date"]))
        {
            apologize("You did not enter a start and/or end date for the preferred date range.");
        }
        
        // check that user entered a recipient's email address
        if (empty($_POST["user2"]))
        {
            apologize("You did not enter a recipient's email address.");
        }
        
        $recipient_id = query("SELECT id FROM users WHERE username = ?", $_POST["user2"]);
        $status = 0;
        // check that the recipient's email address is registered-- THIS DOESN'T WORK BTW.
        if ($recipient_id === false)
        {
            apologize("You did not enter a registered recipient's username (email address).");
        }
        else
        {
            // store user's username
            $_SESSION["username"] = query("SELECT username FROM users WHERE id = ?", $_SESSION["id"])[0]["username"];
            
            // insert new event into databases
            $result = query("INSERT INTO `events` (id, `user 1`, name, duration, `start_time`, `end_time`, 
                `start_date`, `end_date`, description, `user 2`, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                $_SESSION["id"], $_SESSION["username"], $_POST["name"], $_POST["duration"], $_POST["start_time"], $_POST["end_time"], 
                $_POST["start_date"], $_POST["end_date"], $_POST["description"], $_POST["user2"], $status);
                
            // check if INSERT fails
            if ($result === false)
            {
                apologize("INSERT failed!");
            }
            else
            {
                // find out which id was assigned to the user
                $rows = query("SELECT LAST_INSERT_ID() AS request_id");
                $_SESSION["request_id"] = $rows[0]["request_id"];
                
                // redirect to the access page
                redirect("access.php");    
            }  
        }
    }
    else
    {
        // else render form
        render("event_form.php", ["title" => "create request"]);
    }
    
?>
