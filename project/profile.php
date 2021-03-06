<?php require "php/authenticate.php"; ?>

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

  <title>spartalunch - Profile</title>

  <!-- Bootstrap core CSS -->
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
     <div class="container" id="profile">
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <!-- <div class="jumbotron"> -->

      <div>
        <div class="card">
          <div>
            <h2 id="name"></h2>
            <p id="firstName" hidden></p><p id="lastName" hidden></p>
            <div>
             <canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>
             <div class="avatar">
               <img id="profilePic" class="center-block"src="/chi/project/images/sparta.jpg" alt=""/>
             </div>
             <div class="content">
              <p id="age" class="text-center"></p>
              <p id="gender" class="text-center"></p>
              <p id="description" class="text-center"></p>
              <p><button type="button" class="btn btn-default center-block" id="editProfileBtn">Edit</button></p>

              <!-- Edit Profile Form -->
              <div class="modal fade" id="updateProfileModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div Class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 style="color:red;"><span class="glyphicon glyphicon-edit"></span>Edit Profile</h4>
                    </div>
                    <div class="modal-body">
                      <form role="form" id="editProfile">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6"><button class="btn disabled">First name</button></div>
                            <div class="col-md-6"><input type="text" class="form-control" id="firstNameChange"></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6"><button class="btn disabled">Last name</button></div>
                            <div class="col-md-6"><input type="text" class="form-control" id="lastNameChange"></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6"><button class="btn disabled">Age</button></div>
                            <div class="col-md-6"><input type="text" class="form-control" id="ageChange"></div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-6"><button class="btn disabled">Gender</button></div>
                          <div class="col-md-6">
                            <div class="dropdown">
                              <button class="btn btn-default btn-block dropdown-toggle" type="button" id="genderChange" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Gender
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="genderChange">
                                <li><a>Male</a></li>
                                <li><a>Female</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>

                          <!-- <div class="form-group col-md-12">
                            <label for="genderChange" class="col-md-4">Gender</label>
                            <input type="text" class="form-control col-md-8" id="genderChange">
                          </diva> -->
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-6"><button class="btn disabled">Description</button></div>
                              <div class="col-md-6"><textarea id="descriptionChange" form="editProfile" class="form-control" rows="3"></textarea></div>
                            </div>
                          </div>
                          <button type="button" id="submitChanges" class="btn btn-success btn-block" onclick="updateProfile()">Submit</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- </div> --> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
    <script src="js/profile.js"></script>
    <script src="js/spartalunch.js"></script>
    <!-- Session Check
    <script src="js/sessionCheck.js"></script>
    <script>window.onload=checkSession();</script> -->
  </body>
  <html>

