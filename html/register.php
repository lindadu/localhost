<?php
 
/***********************************************************************
     * register.php
     *
     * Computer Science 50
     * meetr
     * Linda Du, Dean Shu, Kevin Jiang
     *
     * Allows new user to register.
     **********************************************************************/
 
 
    // configuration
    require("../includes/config.php");
 
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // check that user entered username
        if (empty($_POST["username"]))
        {
            apologize("You did not enter a username");
        }
        
        // check that user entered a password
        if (empty($_POST["password"]))
        {
            apologize("You did not enter a password");
        }
        // also check that password matches confirmation
        if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords do not match!");
        }
        
        // insert new user into database
        $result = query("INSERT INTO users (username, hash) VALUES(?, ?)",
            $_POST["username"], crypt($_POST["password"]));
            
        // check if INSERT fails
        if ($result === false)
        {
            apologize("INSERT failed!  Perhaps your username already exists");
        }
        else
        {
            // find out which id was assigned to the user
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            
            // remember the id in order to log user in
            $_SESSION["id"] = $id;
            redirect("index.php");
        }      
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
    
?>
 
