<?php session_start() ?>
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/chi/project/">spartalunch</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="#">About</a></li>
              <li><a href="#">Contact</a></li>
              <li><a href="match.php">Find</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["firstName"]?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="availability.php">Availability</a></li>
                  <li><a href="#">Interests</a></li>
                  <li><a href="#">Profile</a></li>
                  <li role="separator" class="divider"></li>
                  <!-- <li class="dropdown-header">Nav header</li> -->
                  <li><a onclick="logout()">Log out</a></li>
                </ul>
              </li>
              </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->