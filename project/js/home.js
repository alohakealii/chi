function logout() {
  $.ajax({
    type: "POST",
    url: "php/logout.php",
    success: function (data) {
      if (data == 'true') {
        sessionStorage.clear();
        window.location = '/';
      }
      else {
        alert("Unable to logout");
      }
    }
  });
}