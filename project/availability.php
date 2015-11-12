<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>spartalunch</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="css/flatly.bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/spartalunch.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">spartalunch</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <!-- <li class="active"><a href="#">Home</a></li> -->
              <li><a href="#">About</a></li>
              <li><a href="#">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="#">Register</a></li>
              <li><a href="#">Log in</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="availability">
        <h1>Availability</h1>
        <p>Set the times that you are free for lunch!</p>
        </div>


      <div class="availability">
        <div class="btn-group">
        <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownDay" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Day
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownDay">
          <li><a>Monday</a></li>
          <li><a>Tuesday</a></li>
          <li><a>Wednesday</a></li>
          <li><a>Thursday</a></li>
          <li><a>Friday</a></li>
        </ul>
        </div>
        </div>

      <div class="btn-group">
        <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownTime" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Time
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownTime">
          <li><a>10:30 - 11:45</a></li>
          <li><a>12:00 - 1:15</a></li>
          <li><a>1:15 - 2:45</a></li>
          <li><a>3:00 - 4:15</a></li>
          <li><a>4:30 - 5:45</a></li>
        </ul>
        </div>
      </div>

      <div class="btn-group">
        <div class="dropdown">
        <button type="button" class="btn btn-success" aria-haspopup="false" aria-expanded="false" onclick="addAvailability()">
          Add
          <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        </button>
        </div>
      </div>

      <div id="availabilityList"></div>

      </div>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
    <script src="js/availability.js"></script>
  </body>
</html>
