$(document).ready(function() {
  retrievePending();
  retrieveAccepted();
});

function acceptRequest(senderID, dayslot) {
  // to do: add option to delete
  $(document).off('click', '#pending-' + senderID); //unbind previous handlers
  $(document).on('click', '#pending-' + senderID, function() {
    $.ajax({
      type: "POST",
      url: "php/acceptRequest.php",
      data: {senderID: senderID, dayslot: dayslot},
      success: function (data) {
        if (data == true) {
          decreasePendingCount();
          addNotification(senderID, dayslot, "accepted");
          // $('#input-' + senderID).remove();
          //$('#input-' + senderID).prepend('<p>' + getEmail(senderID) + '</p><button class="btn btn-danger" onclick="denyRequest(' + senderID + ',&quot;' + dayslot + '&quot;)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>');
          $('#input-' + senderID).addClass("animated fadeOutDown");
          $('#pending-' + senderID + " div:last").before('<div class="animated fadeInDown"><p>' + getEmail(senderID) + '</p><button class="btn btn-danger" onclick="cancelRequest(' + senderID + ',&quot;' + dayslot + '&quot;)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></div>');
          $(document).off('click', '#pending-' + senderID); 
        }
        else {
          alert("Error: accept request failed");
        }
      }
    });
  });
}

// send a notification to a person with receiverID
function addNotification(receiverID, dayslot, action) {
  $.ajax({
      type: "POST",
      url: "php/addNotification.php",
      data: {receiverID: receiverID, dayslot: dayslot, action: action} // ,
      // success: function (data) {
      //   if (data == true) {
      //     console.log(receiverID + " " + dayslot);
      //     console.log("notification sent");
      //     console.log(data);
      //   }
      //   else {
      //     alert("Error: notification failed");
      //     console.log(data);
      //   }
      // }
    });
}

// cancel the request from the receiver's end
function cancelRequest(senderID, dayslot) {
    var request = $('#pending-' + senderID);
    $.ajax({
      type: "POST",
      url: "php/cancelRequest.php",
      data: {senderID: senderID, dayslot: dayslot},
      success: function (data) {
        if (data == true) {
          addNotification(senderID, dayslot, "cancelled");
          request.addClass("animated fadeOutDown");
        }
        else {
          alert("Error: cancel request failed");
          console.log("error:" + data);
        }
      }
    });
}

// cancel the request from the sender's end. example: sender sends request, receiver acccepts, sender cancels
function cancelRequestSender(receiverID, dayslot) {
    var request = $('#pending-' + receiverID);
    $.ajax({
      type: "POST",
      url: "php/denyRequestSender.php",
      data: {receiverID: receiverID, dayslot: dayslot},
      success: function (data) {
        if (data == true) {
          addNotification(receiverID, dayslot, "cancelled");
          request.addClass("animated fadeOutDown");
        }
        else {
          alert("Error: cancel request failed");
        }
      }
    });
}


function decreasePendingCount() {
  var count = parseInt($('#notification-count').html()) - 1;
  $('#notification-count').html(count);
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
          countNotification();
          addNotification(senderID, dayslot, "denied");
          request.addClass("animated fadeOutDown");
          // request.addClass("animated fadeOutDown").delay(250).queue(function(next) {
          //   next();
          // });
        }
        else {
          alert("Error: deny request failed");
        }
      }
    });
  });
}

function getEmail(userID) {
  var response = $.ajax({
    type: "POST",
    url: "php/getEmail.php",
    data: {userID: userID},
    async: false
    }).responseText;

  var email = JSON.parse(response);
  return email[0]["email"];
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
        var html = '<div id="pending-' + elem["receiverID"] + '" class="col-lg-4 animated bounceIn">' +
          '<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">' +
          '<h2>' + elem["firstName"] + ' ' + elem["lastName"] + '</h2>' +
          '<p>' + elem["dayslot"] + '</p>' +
          '<p>' + elem["email"]  + '</p>' +
          '<button class="btn btn-danger" onclick="cancelRequest(' + elem["receiverID"] + ',&quot;' + elem["dayslot"] + '&quot;)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>' +
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
      console.log(requests);
      var htmlArr = [];
      for (i = 0; i < requests.length; i++) {
        var elem = requests[i];
        var html = '<div id="pending-' + elem["senderID"] + '" class="col-lg-4 animated bounceIn">' +
          '<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">' +
          '<h2>' + elem["firstName"] + ' ' + elem["lastName"] + '</h2>' +
          '<p>' + elem["dayslot"] + '</p>';
          if (elem["status"] == "Pending") {
            html = html + '<div id="input-' + elem["senderID"] + '"><button type="button" class="btn btn-success" onclick="acceptRequest(' + elem["senderID"] + ", &quot;" + elem["dayslot"] + '&quot;)">Accept <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>' +
            '<button type="button" class="btn btn-danger" onclick="denyRequest(' + elem["senderID"] + ", &quot;" + elem["dayslot"] + '&quot;)">Deny <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></div>';
          }
          else {
            html = html + '<p>' + elem["email"]  + '</p>' +
            '<button class="btn btn-danger" onclick="cancelRequest(' + elem["senderID"] + ',&quot;' + elem["dayslot"] + '&quot;)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
          }
          html = html + '</div>';
        htmlArr.push(html);
      }

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