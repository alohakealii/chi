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