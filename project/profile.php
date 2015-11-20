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

  <title>Navbar Template for Bootstrap</title>

  <!-- Bootstrap core CSS -->
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="css/flatly.bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/navbar.css" rel="stylesheet">
  <link href="css/profile.css" rel="stylesheet">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body onload="forGuest()"><!-- onload="forGuest()" -->
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
            <a class="navbar-brand" href="index.html">spartalunch124</a>
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
              <li><a href="#">Log Out</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container" id="profile">
        	
          <div class="row">
           <div>
            <div class="card">
              <div>
                <h2 id="name"></h2>
                <p id="firstName" hidden></p><p id="lastName" hidden></p>
                <div>
                 <canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>
                 <div class="avatar">
                   <img class="center-block"src="http://img2.wikia.nocookie.net/__cb20140321040656/ncaa-football/images/c/c0/San_Jose_State_Spartans.jpg" alt=""/>
                 </div>
                 <div class="content">
                  <p id="age" class="text-center"></p>
                  <p id="gender" class="text-center"></p>
                  <p id="description" class="text-center"></p>
                  <p><button type="button" class="btn btn-default center-block" id="editProfileBtn">Edit</button></p>

                  <!-- Edit Profile Form -->
                  <form id="editProfile" style="display:none;" class="form-inline">
                    <div class="form-group">
                      <label for="firstNameChange">First Name</label>
                      <input type="text" class="form-control" id="firstNameChange">
                    </div>
                    <div class="form-group">
                      <label for="lastNameChange">Last Name</label>
                      <input type="text" class="form-control" id="lastNameChange">
                    </div>
                    <div class="form-group">
                      <label for="ageChange">Age</label>
                      <input type="text" class="form-control" id="ageChange">
                    </div>
                    <div class="form-group">
                      <label for="genderChange">Gender</label>
                      <input type="text" class="form-control" id="genderChange">
                    </div>
                    <div class="form-group">
                      <label for="descriptionChange">Description</label>
                      <input type="text" class="form-control" id="descriptionChange">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="updateProfile()">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
    <script src="js/registerAccount.js"></script>
    <script src="js/profile.js"></script>
  </body>
  <html>