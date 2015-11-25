$(document).ready(function() {
  retrievePending();
  retrieveAccepted();
});

function acceptRequest(senderID, dayslot) {
  // remove buttons, add option to delete
  // display contact information
  $(document).off('click', '#pending-' + senderID); //unbind previous handlers
  $(document).on('click', '#pending-' + senderID, function() {
    var request = $(this);
    $.ajax({
      type: "POST",
      url: "php/acceptRequest.php",
      data: {senderID: senderID, dayslot: dayslot},
      success: function (data) {
        if (data == true) {
          // decreasePendingCount();
          addNotification(senderID, dayslot);
        }
        else {
          console.log(data);
          alert("Error: accept request failed");
        }
      }
    });
  });
}

function addNotification(userID, dayslot) {
  $.ajax({
      type: "POST",
      url: "php/addNotification.php",
      data: {userID: userID, dayslot: dayslot},
      success: function (data) {
        if (data == true) {
          console.log("notification sent");
        }
        else {
          console.log(data);
          alert("Error: accept request failed");
        }
      }
    });
}

function decreasePendingCount() {
  var count = parseInt($('#count').html()) - 1;
  $('#count').html(count);
}

function denyRequest(senderID, dayslot) {
  $(document).off('click', '#pending-' + senderID); //unbind previous handlers
  $(document).on('click', '#pending-' + senderID, function() { // dynamically added elements needs to use on() to bind function
    var request = $(this);
    $.ajax({
      type: "POST",
      url: "php/denyRequest.php",
      data: {senderID: senderID, dayslot: dayslot},
      success: function (data) {
        if (data == true) {
          decreasePendingCount();
          request.addClass("animated fadeOutDown").delay(250).queue(function(next) {
            next();
          });
        }
        else {
          alert("Error: deny request failed");
        }
      }
    });
  });
}

function retrieveAccepted() {
  var response = $.ajax({
    type: "POST",
    url: "php/retrieveAccepted.php",
    async: false
    }).responseText;
    if (response != 0) {
      var requests = JSON.parse(response);
      var htmlArr = [];
      for (i = 0; i < requests.length; i++) {
        var elem = requests[i];
        var html = '<div id="pending-' + elem["senderID"] + '" class="col-lg-4 animated bounceIn">' +
          '<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">' +
          '<h2>' + elem["firstName"] + ' ' + elem["lastName"] + '</h2>' +
          '<p>' + elem["dayslot"] + '</p>' +
          '</div>';
        htmlArr.push(html);
      }

      // shuffle(matchesHTML);
      // $('#matchList').empty();
      $('#pendingList').append(htmlArr.pop()); // pop first element with no delay
      for (i = 0; i < htmlArr.length; i++) {
        $('#pendingList').delay(250).queue(function(next) {
            $(this).append(htmlArr.pop()); // append next element after 250 ms delay
            // scroll to bottom of page each time element is added, has unncessary calls but it works for now
            $("html, body").animate({ scrollTop: $(document).height() }, "fast");
            next();
        });
      }
    }
}

function retrievePending() {
  var response = $.ajax({
    type: "POST",
    url: "php/retrievePending.php",
    async: false
    }).responseText;
    if (response != 0) {
      var requests = JSON.parse(response);
      var htmlArr = [];
      for (i = 0; i < requests.length; i++) {
        var elem = requests[i];
        var html = '<div id="pending-' + elem["senderID"] + '" class="col-lg-4 animated bounceIn">' +
          '<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">' +
          '<h2>' + elem["firstName"] + ' ' + elem["lastName"] + '</h2>' +
          '<p>' + elem["dayslot"] + '</p>';
          if (elem["status"] == "Pending") {
            html = html + '<button type="button" class="btn btn-success" onclick="acceptRequest(' + elem["senderID"] + ", &quot;" + elem["dayslot"] + '&quot;)">Accept <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>' +
            '<button type="button" class="btn btn-danger" onclick="denyRequest(' + elem["senderID"] + ", &quot;" + elem["dayslot"] + '&quot;)">Deny <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
          }
          html = html + '</div>';
        htmlArr.push(html);
      }

      // shuffle(matchesHTML);
      // $('#matchList').empty();
      $('#pendingList').append(htmlArr.pop()); // pop first element with no delay
      for (i = 0; i < htmlArr.length; i++) {
        $('#pendingList').delay(250).queue(function(next) {
            $(this).append(htmlArr.pop()); // append next element after 250 ms delay
            // scroll to bottom of page each time element is added, has unncessary calls but it works for now
            $("html, body").animate({ scrollTop: $(document).height() }, "fast");
            next();
        });
      }
    }
}