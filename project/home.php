<?php require 'php/authenticate.php'; ?>

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

  <title>spartalunch - Home</title>

  <link href="css/flatly.bootstrap.min.css" rel="stylesheet">
  <link href="css/spartalunch.css" rel="stylesheet">
  <link href="css/masonry.css" rel="stylesheet" type="text/css" >
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body>

      <div class="container">

        <nav class="navbar navbar-default">
        </nav>

        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron resize-center">
          <h1>Welcome <?php echo $_SESSION["firstName"]?>!</h1>
          <p>First, set the times that you are <a href="availability.php">available</a> or check below for some food suggestions!</p>
        </div>

        <div class="grid" id="grid">
          <div class="grid-sizer"></div>
        </div>

      </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/spartalunch.js"></script>
    <!-- Session Check
    <script src="js/sessionCheck.js"></script>
    <script>window.onload=checkSession();</script> -->
    <script src="js/home.js"></script>
    <script src="js/imagesloaded.pkgd.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
  </body>
  </html>
