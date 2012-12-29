

<!--
<div align="right">
    <div class="btn-group pull-right">
        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            <?php 
                $result = query("SELECT username FROM users WHERE 
                    id = ?", $_SESSION["id"]);
                $_SESSION["username"] = $result[0]["username"];
                print("hello" ." ".  $_SESSION["username"] . "!"); 
            ?>
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="event.php">Create Event Request</a></li>
            <li><a href="access.php">Accept</a></li>
            <li><a href="delete.php">Ignore</a></li>
            <li><a href="help.php">Help</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
</div>
-->


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>meetr: A new way to schedule meetings and events.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="../ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Inbox</a></li>
              <li><a href="/event.php">Create Event</a></li>
              <li><a href="/logout.php">Log out</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        </br>
        </br>
        </br>
        <p>Respond to your events.</p>
      </div>

      <div class="row">

        <div class="span6">
          <h2>Received</h2>
          <div>
<?php
// check if array is empty
if(empty($received_info))
{
    print("<p>No requests in your inbox. </p></div></div>");
}
else
{
    echo "<table class=\"table table-striped\"><thead><tr><th>Event name</th><th>From</th><th>Reply</th></tr></thead><tbody>";
    
    // iterate through received requests
    foreach ($received_info as $info)
    {
        print"<tr>";
        print("<td>" . $info["name"] . "</td>");
        print("<td>" . $info["user 1"] . "</td>");
        print("<td>");?>
        
        <!-- create two buttons (accept/ignore) that pass on request id using hidden forms-->
        <form action='access.php' method='post'><div class='control-group'>
        <input name='accrequestid' value=' <?php echo $info["request id"]; ?> ' type='hidden'/>
        <button type='submit' id= 'accept' class='btn btn-success'>Accept</button></div>
        </fieldset></form>
        
        <form action='delete.php' method='post'><div class='control-group'>
        <input name='delrequestid' value=' <?php echo $info["request id"]; ?>' type='hidden'/>
        <button type='submit' id= 'ignore' class='btn btn-danger'>Ignore</button></div>
        </fieldset></form></td>
        <?php
        print("</tr>");
    }
    
     echo "</tbody></table></div></div>";
    
}
?>

        
        <div class="span6">
          <h2>Sent</h2>
          <div>

<?php
// check if array is empty
if(empty($sent_info))
{
    print("<p>You have no sent requests that are currently pending. </p></div></div>");
}
else
{
    echo "<table class=\"table table-striped\"><thead><tr><th>Event name</th><th>To</th><th>Status</th></tr></thead><tbody>";
    // iterate through all sent requests that are currently pending
    foreach ($sent_info as $info)
    {
        print"<tr>";
        print("<td>" . $info["name"] . "</td>");
        print("<td>" . $info["user 2"] . "</td>");
        print("<td>" . "Pending" . "</td>");
        print("</tr>");
    }
    
    echo "</tbody></table></div></div>";
}

?>

      </div>
      
      <hr>

      <footer>
        <p>&copy; meetr 2012</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap-transition.js"></script>
    <script src="../js/bootstrap-alert.js"></script>
    <script src="../js/bootstrap-modal.js"></script>
    <script src="../js/bootstrap-dropdown.js"></script>
    <script src="../js/bootstrap-scrollspy.js"></script>
    <script src="../js/bootstrap-tab.js"></script>
    <script src="../js/bootstrap-tooltip.js"></script>
    <script src="../js/bootstrap-popover.js"></script>
    <script src="../js/bootstrap-button.js"></script>
    <script src="../js/bootstrap-collapse.js"></script>
    <script src="../js/bootstrap-carousel.js"></script>
    <script src="../js/bootstrap-typeahead.js"></script>

  </body>
</html>
    

