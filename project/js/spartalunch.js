$(document).ready(function() {
	$.get('php/session_check.php', function(data) {
		if (data.indexOf("active") != -1) {
			$("nav").load("parts/userheader.php");
    }
		else {
			$("nav").load("parts/anonheader.html");
    }
	});

  initMap();
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
        window.location = 'login.php';
      }
      else {
        alert("Unable to logout");
      }
    }
  });
}

function match() {
  var response = $.ajax({
    type: "POST",
    url: "php/getMatch.php",
    async: false
    }).responseText;

    if (response != 0) {
      var matches = JSON.parse(response);
      var html = "";
      var test = [];
      for (i = 0; i < matches.length; i++) {
        var elem = matches[i];
        // var html = "<p>" + elem["firstName"] + " " + elem["lastName"] + " " + elem["day"] + " " + elem["slot"] + "</p>";
        html = '<div id="matchElem" class="col-lg-4 animated bounceIn">' +
          '<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">' +
          '<h2>' + elem["firstName"] + '</h2>' +
          '<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>' +
          '<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>' +
        '</div>';
        
        test.push(html);
        html = "";
        
      }

      $('#matchList').append(test.pop());
      $('#matchList').delay(500).queue(function(next) {

          $(this).append(test.pop());
          next();
        });
      


      //$('#matchList').append(test.pop());
      // $('#matchList').append(test.pop());
      // $('#matchList').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
      //     $('#matchList').append(test.pop());
      //   });


    }
}

// function initMap() {
//   // Create a map object and specify the DOM element for display.
//   var map = new google.maps.Map(document.getElementById('map'), {
//     center: {lat: 37.334993, lng: -121.881168},
//     zoom: 12
//   });
// }

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