$(document).ready(function() {
  var notifications = retrieveNotification();
  var pendingCount = parseInt(countPending()); 
  var totalCount = pendingCount;

  if (notifications != 0) {
    console.log(totalCount + " " + notifications.length);
    totalCount = totalCount + notifications.length;
    for (i = 0; i < notifications.length; i++) {
      var li = '<li><a>' + notifications[i] + '</a></li>';
      $('#notifications').append(li);
    }
  }

  if (pendingCount > 0) {
    var requestCount = '<li><a href="request.php" id="request-count">Requests (' + pendingCount + ')</a></li>';
    $('#notifications').prepend(requestCount);
  }

  if (totalCount > 0) {
    $('#notification-count').html(totalCount);
    // $('#notification-count').addClass("animated wobble");
  }
  else {
    $('#notifications').prepend('<li><a href="request.php" id="request-count">Nothing here</a></li>');
  }
});

function countPending() {
  return $.ajax({
      type: "POST",
      url: "php/countPending.php",
      async: false
      }).responseText;
}

function retrieveNotification() {
  var response = $.ajax({
    type: "POST",
    url: "php/retrieveNotification.php",
    async: false
    }).responseText;

  if (response != 0) {
    var notifications = JSON.parse(response);
    var format = [];
    for (i = 0; i < notifications.length; i++) {
    var notificationString = notifications[i]["firstName"] + " " + notifications[i]["lastName"] + " " + notifications[i]["action"] + " your request for " + notifications[i]["dayslot"]; 
    format[i] = notificationString;
  }
  return format;
  }
  else {
    return response;
  }

  
}