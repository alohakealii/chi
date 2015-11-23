<?php
session_start();
?>

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
  <link href="css/animate.css" rel="stylesheet">

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
          <div>
            <h1>Pending requests</h1>
            <p>Accept or deny requests</p>
          </div>
          <div id="requestList">
          <div class="col-xs-3"><button class="btn btn-block disabled">sample name</button></div>
          <div class="col-xs-3"><button class="btn btn-block disabled">monday 10-30 - 11:45</button></div>
                <div class="col-xs-2"><button class="btn btn-block disabled">pending</button></div>
                <div class="col-xs-2"><button class="btn btn-block disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></div>
                <div class="col-xs-2"><button class="btn btn-block disabled"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></div>
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
              <div class="modal-body">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        

      </div> <!-- /container -->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
    <script src="js/spartalunch.js"></script>
  </body>
  </html>