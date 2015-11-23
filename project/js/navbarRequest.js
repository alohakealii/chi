$(document).ready(function() {
  var count = $.ajax({
      type: "POST",
      url: "php/pendingCount.php",
      async: false
      }).responseText;

  var requests = '<li class="dropdown">' +
      '<a href="request.php" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">' +
        'Requests <span class="badge" id="count">' + count + '</span>' +
      '</a>' +
    '</li>';
  $('#navbar-right').prepend(requests);
});