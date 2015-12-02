$(document).ready(function() {
  countNotification();
});

function countNotification() {
  var notifications = retrieveNotification();
  var pendingCount = $.ajax({
      type: "POST",
      url: "php/countPending.php",
      async: false
      }).responseText;
  var totalCount = parseInt(pendingCount);

  if (notifications != 0) {
    totalCount = totalCount + notifications.length;
    for (i = 0; i < notifications.length; i++) {
      $('#notifications').append(notifications[i]);
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
    $('#notifications').empty();
    $('#notifications').prepend('<li><a id="request-count">Nothing here</a></li>');
  }
}

function removeNotification(itemID, senderID, dayslot) {
  $.ajax({
    type: "POST",
    url: "php/removeNotification.php",
    data: {senderID: senderID, dayslot: dayslot},
    success: function (data) {
      if (data == 1) {
        $('#notification-' + itemID).remove();
        countNotification();
        var count = parseInt($('#notification-count').html()) - 1;
        $('#notification-count').html(count);
      }
      else {
        alert("error");
      }
    }
  });
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
    notificationString = '<li id="notification-' + i + '"><a onclick="removeNotification(' + i + ',' + notifications[i]["senderID"] + ',&quot;' + notifications[i]["dayslot"] + '&quot;)">' + notificationString + '</li></a>';
    format[i] = notificationString;
  }
  return format;
  }
  else {
    return response;
  }

  
}