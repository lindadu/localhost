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
              <li><a href="/index.php">Inbox</a></li>
              <li class="active"><a href="#">Create Event</a></li>
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
        <p>Enter your event details.</p>
      </div>

      <!-- Example row of columns -->
      <div class="row">

        <div class="span12">
          <h2>Create a new event</h2>
          <div>
<form action="event.php" method="post">
    <fieldset>
   
        <div class="control-group">
            <input autofocus name="name" placeholder="event name" type="text"/>
        </div>
        
        <div class="control-group">
        <!-- probably should somehow limit to 30 minute increments -->
            <input autofocus name="duration" placeholder="event duration in hours" type="text"/>
        </div>
        
        <div class="control-group">
        <label>  Please select a time range that the event will fall in: </label>
            <input type="time" name="start_time"/>
        to
            <input type="time" name="end_time"/>
        </div>
        
        <div class="control-group">
        <label> Please enter a date range that you would like the event to occur within </label>
            <input type="date" name="start_date">
        to 
            <input type="date" name="end_date">
        </div>
      
        <div class="control-group">
        <label>  Event description (optional):
            <textarea name="description" rows="4" cols="8">
            
            </textarea>
        </label>
        </div>
        
          
        <div class="control-group">
            <input name="user2" placeholder="recipient's username (email)!" type="email"/>
        </div>
        
        <div class="control-group">
            <button type="submit" class="btn" id="eventSubmit">send request</button>
        </div>
      
    </fieldset>
</form>
          </div>
        </div>

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

