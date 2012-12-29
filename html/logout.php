<?php
 
    // configuration
    require("../includes/config.php"); 
 
    // log out current user, if any
    logout();
 
    // redirect user
    render("/loggedout_designed.php", ["title" => "logged out!"]);
 
?>
