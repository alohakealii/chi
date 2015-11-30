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

  <title>spartalunch - Match</title>

  <!-- Bootstrap core CSS -->
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="css/flatly.bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/spartalunch.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">

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
        <div class="jumbotron">
          <div>
            <h1>Match</h1>
            <p>Find someone to eat lunch with!</p>
          </div>

          <div id="matchInput">
            <button class="btn btn-success" onclick="match()">Match me</button>
          </div>
        </div>

        <!-- Large modal -->
        <div class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="gridSystemModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Availability</h4>
              </div>
              <div class="modal-body" id="schedule">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <div class="container marketing">
          <!-- Three columns of matches -->
          <div class="row" id="matchList">
          </div><!-- /.row -->
        </div>

      </div> <!-- /container -->

    <!-- to be continued...
    <div class="footer" style="text-align:center">
      <a href="#">About</a>
      </div>
    </div> -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
    <script src="js/spartalunch.js"></script>
    <!-- Session Check -->
    <script src="js/sessionCheck.js"></script>
    <script>window.onload=checkSession();</script>
  </body>
  </html>