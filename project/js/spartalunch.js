$(document).ready(function() {
  $.get('php/sessionCheck.php', function(data) {
    if (data.indexOf("active") != -1) {
      $("nav").load("parts/userheader.php");
    }
    else {
      $("nav").load("parts/anonheader.html");
    }
  });

  initMap();
});

function createAvailabilityBtn(availabilityString, requestID) {
  var formatID = createSlotID(availabilityString);
  var param = "'" + formatID + "'";
  var button = '<button class="btn btn-primary btn-block" '  +
                'title="Click to send a request" ' +
                'onclick="sendRequest(' + requestID + ',&quot;' + availabilityString + '&quot;)">' + 
                availabilityString +
                '</button>';
  return button;
}

// takes a string in format "DAY 00:00 - 00:00" and returns an id "DAY000000"
function createSlotID(availabilityString) {
  return availabilityString.replace(/\s|:|-/g, "");
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
    error: function(data) {
      alert("error");
      //console.log(data);
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

// finds names of users with matching availability and generates html results for each match
// matches are pushed on an array, shuffled, then popped off one by one with animated effects
function match() {
  var response = $.ajax({
    type: "POST",
    url: "php/getMatchName.php",
    async: false
    }).responseText;

    if (response != 0) {
      var matches = JSON.parse(response);
      var matchesHTML = [];
      for (i = 0; i < matches.length; i++) {
        var elem = matches[i];
        var html = '<div class="col-lg-4 animated bounceIn">' +
          '<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">' +
          '<h2>' + elem["firstName"] + ' ' + elem["lastName"] + '</h2>' +
          '<p>' + elem["description"] + '</p>' +
          '<button type="button" class="btn btn-primary" onclick="matchDetails(' + elem["userID"] + ')" data-toggle="modal" data-target=".bs-example-modal-lg">Details</button>' +
        '</div>';
        matchesHTML.push(html);
      }

      shuffle(matchesHTML);
      $('#matchList').empty();
      $('#matchList').append(matchesHTML.pop()); // pop first element with no delay
      for (i = 0; i < matchesHTML.length; i++) {
        $('#matchList').delay(250).queue(function(next) {
            $(this).append(matchesHTML.pop()); // append next element after 250 ms delay
            // scroll to bottom of page each time element is added, has unncessary calls but it works for now
            $("html, body").animate({ scrollTop: $(document).height() }, "fast");
            next();
        });
      }
    }
}

// display availability details of a match: availability and status of corresponding request
function matchDetails(targetID) {
  var response = $.ajax({
    type: "POST",
    url: "php/getMatchAvailability.php",
    data: {targetID: targetID},
    async: false
    }).responseText;

    // generate the content in the modal: rows containing a request button and the status of the request
    if (response != 0) {
      // reset the modal and add the legend row
      $('#schedule').empty();
      var legend = '<div class="row">' +
                    '<div class="col-xs-6"><h5>Click to request</h5></div>' +
                    '<div class="col-xs-6"><h5>Status</h5></div>' +
                    '</div>';
      $('#schedule').append(legend);

      // create and append the request button and (empty) status rows
      var availSlots = JSON.parse(response);
      for (i = 0; i < availSlots.length; i++) {
        var elem = availSlots[i]["dayslot"];
        var id = createSlotID(elem);
        var btn = createAvailabilityBtn(elem, targetID); // creates button for sending requests
        var html = '<div class="row">' +
                    '<div class="col-xs-6">' + btn + '</div>' +
                    '<div class="col-xs-6"><button id="' + id + '" class="btn btn-block disabled"></button></div>' +
                    '</div>';
        $('#schedule').append(html);
      }
      // retrieve statuses of each availability edit the statuses accordingly
      var statuses = retrieveStatus(targetID);
      if (statuses != 0) {
        for (i = 0; i < statuses.length; i++) {
          id = createSlotID(statuses[i]["dayslot"]);
          $('#' + id).html(statuses[i]["status"]);
        }
      }
    }
}

function register() {
    var first = document.getElementById('firstName').value;
    var last = document.getElementById('lastName').value;
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var email = document.getElementById('email').value;

    $.ajax({
        type: "POST",
        url: "php/registerAccount.php",
        data: {firstName: first, lastName: last, username: username, password: password, email: email},
        success: function (data) {
          if (data != false) {
            alert("Registration successful!");
            window.location = 'login.php';
          }
          else {
            alert("Error: username is taken");
          }
        },
        error: function(data) {
            alert("There was an error");
        }
    });   
}

function retrieveStatus(targetID) {
  var response = $.ajax({
    type: "POST",
    url: "php/retrieveStatus.php",
    data: {targetID: targetID},
    async: false
    }).responseText;

  if (response != 0) {
      return JSON.parse(response);
  }
  else {
    return response;
  }
}

function sendRequest(targetID, availabilityString) {
  $.ajax({
    type: "POST",
    url: "php/addRequest.php",
    data: {targetID: targetID, daySlot: availabilityString},
    success: function (data) {
      if (data == true) {
        var id = createSlotID(availabilityString);
        $('#'+id).html("Pending");
      }
      else {
        alert("Request failed: request is pending, accepted, or denied");
      }
    }
  });
}

function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex ;
  // While there remain elements to shuffle...
  while (0 !== currentIndex) {
    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;
    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }
  return array;
}

function initMap() {
  // run init the first time the modal opens
  var created = false;
  $('#map-modal').on('shown.bs.modal', function() {
    if (!created) {
      initAutocomplete();
      created = true;
    }
  });
}

function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 37.334993, lng: -121.881168},
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();
    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    // map.fitBounds(bounds);
  });
}