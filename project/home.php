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

    <title>spartalunch</title>

    <link href="css/flatly.bootstrap.min.css" rel="stylesheet">
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

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Welcome <?php echo $_SESSION["firstName"]?>!</h1>
        <p>First, set the times that you are <a href="availability.php">available</a></p>
      </div>

<div class="grid">
          <div class="grid-sizer"></div>
  
  <div class="grid-item">
    <img src="images/360grill.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/lavictorias.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/brickspizzapasta.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/tapiocaexpress.png" />
  </div>
  <div class="grid-item">
    <img src="images/inthemix.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/amorcafetea.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/jambajuice.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/sanpedrosquare.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/leboulanger.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/mojoburger.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/pandaexpress.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/peanuts.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/originalgravity.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/philz.png" />
  </div>
  <div class="grid-item">
    <img src="images/tacobell.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/whispers.jpg" />
  </div>
  <div class="grid-item">
    <img src="images/wafflecoop.jpg" />
  </div>
</div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/spartalunch.js"></script>
    <script src="js/home.js"></script>
    <script src="js/imagesloaded.pkgd.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
  </body>
</html>
