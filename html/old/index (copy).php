<?php

    // configuration
    require("../includes/config.php"); 
    
    // query for event information for "received" section of inbox
    $username = query("SELECT username FROM users WHERE id =?",$_SESSION["id"])[0]["username"];
    $received_info = query("SELECT name, `user 1`, `request id` FROM events WHERE `user 2` =?", $username);

    // query for event information for "sent" section of inbox
    $sent_info = query("SELECT name, `user 2`, status FROM events WHERE id = ?", $_SESSION["id"]);
    
    // redirect to inbox
    render("inbox.php", ["title" => "inbox", "received_info" => $received_info, 
        "sent_info" => $sent_info]);

?>
