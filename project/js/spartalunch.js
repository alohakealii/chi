$(document).ready(function() {

  $.get('php/session_check.php', function(data) {
    if (data.indexOf("active") != -1) {
      $("nav").load("parts/userheader.php");z
    }
    else {
      $("nav").load("parts/anonheader.html");
    }
  });
});

function register() {
    var first = document.getElementById('firstName').value;
    var last = document.getElementById('lastName').value;
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    $.ajax({
        type: "POST",
        url: "php/registerAccount.php",
        data: {firstName: first, lastName: last, username: username, password: password},
        success: function (data) {
            alert("Registration successful!");
            //document.location.href = "index.html";
            window.location = 'login.php';
        },
        error: function(xhr, status, error) {
            var err = eval( xhr.responseText );
            alert(err.Message);
        }
    });   
}

function login() {
  var username = $("#usernameInput").val();
  var password = $("#passwordInput").val();

  $.ajax({
    type: "POST",
    url: "php/setSession.php",
    data: {username: username, password: password},
    success: function (data) {
      if (data == true) {
        window.location = 'home.php';
      }
      else {
        alert("error:" + data);
      }
      
    },
    error: function(xhr, status, error) {
      var err = eval( xhr.responseText );
      alert(err.Message);
    }
  });
}

function logout() {
  $.ajax({
    type: "POST",
    url: "php/logout.php",
    success: function (data) {
      if (data == 'true') {
        sessionStorage.clear();
        window.location = 'login.php';
      }
      else {
        alert("Unable to logout");
      }
    }
  });
}

function match() {
  var response = $.ajax({
    type: "POST",
    url: "php/getMatch.php",
    async: false
    }).responseText;

    if (response != 0) {
      var matches = JSON.parse(response);
      var html = "";
      var test = [];
      for (i = 0; i < matches.length; i++) {
        var elem = matches[i];
        // var html = "<p>" + elem["firstName"] + " " + elem["lastName"] + " " + elem["day"] + " " + elem["slot"] + "</p>";
        html = '<div id="matchElem" class="col-lg-4 animated bounceIn">' +
          '<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">' +
          '<h2>' + elem["firstName"] + '</h2>' +
          '<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>' +
          '<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>' +
        '</div>';
        
        test.push(html);
        html = "";
        
      }

      $('#matchList').append(test.pop());
      $('#matchList').delay(500).queue(function(next) {

          $(this).append(test.pop());
          next();
        });
      


      //$('#matchList').append(test.pop());
      // $('#matchList').append(test.pop());
      // $('#matchList').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
      //     $('#matchList').append(test.pop());
      //   });


    }
}