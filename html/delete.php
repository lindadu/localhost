<?php
require("../includes/config.php");

// if a request id is passed via a form, we know that user is ignoring a request
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $_SESSION["request_id"] = $_POST["delrequestid"];
    }

// remove request from database
query("DELETE FROM `events` WHERE `request id` = ?", $_SESSION["request_id"]);
query("DELETE FROM `requests` WHERE `request_id` = ?", $_SESSION["request_id"]);

redirect("index.php");
?>
