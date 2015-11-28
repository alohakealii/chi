// $(document).ready(function() {

//   $.get('php/session_check.php', function(data) {
//     if (data.indexOf("active") != -1) {
//       alert("You are logged in. Have fun with the special page!");
//     }
//     else {
//       alert("This page requires you to log in");
//       window.location = '/project/';
//     }
//   });
// });

function checkSession() {
  // alert("Check session");
  $.ajax({
    type: "POST",
    url: "php/sessionCheck.php",
    success: function (data) {
      if (data.indexOf("active") == -1) {
        alert("Restricted page: please log in to access")
        window.location = '/project/login.php';
      } else {
        // alert("Logged in page");
      }
    }
  });
}
