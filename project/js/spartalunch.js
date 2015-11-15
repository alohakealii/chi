$(document).ready(function() {

	$.get('/chi/project/php/session_check.php', function(data) {
		if (data.indexOf("active") != -1) {
			$("nav").load("/chi/project/parts/userheader.php");
    }
		else {
			$("nav").load("/chi/project/parts/anonheader.html");
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
    url: "php/verifyLogin.php",
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
        window.location = '/chi/project';
      }
      else {
        alert("Unable to logout");
      }
    }
  });
}