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

    <title>spartalunch - Registration</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="css/flatly.bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/spartalunch.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <nav class="navbar navbar-default">
      </nav>

      <div class="jumbotron">
        <h1>Register</h1>
        <p>Sign up now to start using spartalunch!</p>

        <!-- Registration form -->
        <form id="registration-form">
          <div class="form-group">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" placeholder="First name">
          </div>
          <div class="form-group">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" placeholder="Last name">
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" placeholder="Email">
          </div>
          <div class="form-group">
            <button id="register-submit" type="button" class="btn btn-primary" onclick="register()">Submit</button>
          </div>
        </form>

      </div>

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
