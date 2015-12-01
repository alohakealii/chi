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
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-default">
    </nav>

    <div class="jumbotron resize-center">
      <h1>Welcome <?php echo $_SESSION["firstName"]?>!</h1>
      <p>First, set the times that you are <a href="availability.php">available</a> or check below for some food suggestions!</p>
    </div>

    <!-- Google Maps Modal -->
    <div id="map-modal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">San Jose State University</h4>
          </div>
          <div class="modal-body">
            <input id="pac-input" class="controls" type="text" placeholder="Search Box"/>
            <div id="map"></div>
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div> -->
        </div>
      </div>
    </div>

    <div class="grid" id="grid">
      <div class="grid-sizer"></div>
    </div>

  </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    <script src="js/spartalunch.js"></script>
    <script src="js/home.js"></script>
    <!-- masonry library -->
    <script src="js/imagesloaded.pkgd.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
  </body>
  </html>
