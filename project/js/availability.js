$(document).ready(function() {
  $('#contentInfo').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
    function() {
      $('#availabilityInputs').removeClass('hidden');
      $('#availabilityInputs').addClass('animated fadeInDown');
    }
  );
  
  retrieveAvailability();

  $(".dropdown-menu li a").click(function(){
    $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
    $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
  });


});



function addAvailability() {
  var day = $('#dropdownDay').text().trim();
  var time = $('#dropdownTime').text().trim();

  if (day == "Day" || time == "Time") {
    alert("Please select a day or time");
  }
  else {
    $.ajax({
      type: "POST",
      url: "php/addAvailability.php",
      data: {day: day, time: time},
      success: function (data) {
        if (data == true) {
          var button = createAvailabilityBtn(day + " " + time);
          $('#availabilityList').append(button);
        }
        else {
          alert("error");
        } 
      },
      error: function(data) {
        console.log(data);
      }
    }); 
  }
}

function removeAvailability(id) {
  $(document).off('click', '#' + id); //unbind previous handlers
  $(document).on('click', '#' + id, function() {
    var button = $(this);
    // use reg exp to split button text into parameters for ajax call
    var dateText = button.text();
    var dateRE = new RegExp(/([a-zA-Z]*)\s([0-9]*:[0-9]*\s-\s[0-9]*:[0-9]*)/);
    var split = dateRE.exec(dateText);
    var day = RegExp.$1;
    var time = RegExp.$2;

    // delete availability from database and remove from view on success
    $.ajax({
      type: "POST",
      url: "php/removeAvailability.php",
      data: {day: day, time: time},
      success: function (data) {
        if (data == true) {
          button.parent().addClass("animated bounceOutDown");
          // button.parent().one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
          //   function() {
          //     button.parent().remove();
          //   });
          
          // button.parent().remove();
        }
        else {
          alert("error");
        } 
      },
      error: function(xhr, status, error) {
        var err = eval( xhr.responseText );
        alert(err.Message);
      }
    });

  });
}

// retrieves availability from db using username stored in session and creates a button for each row
function retrieveAvailability() {
  var response = $.ajax({
    type: "POST",
    url: "php/retrieveAvailability.php",
    async: false
    }).responseText;

    if (response != 0) {
      var availabilityArray = JSON.parse(response);
      for (i = 0; i < availabilityArray.length; i++) {
        var button = createAvailabilityBtn(availabilityArray[i]["day"] + " " + availabilityArray[i]["slot"]);

        // no delay on adding the first element
        if (i == 0) {
          $('#availabilityList').append(button);
        }
        else {
          $('#availabilityList').delay(300).queue(function(next) {
            $(this).append(button);
            next();
          });
        }

      }
      

    }
}

// takes a string in format "DAY 00:00 - 00:00" and tranforms it into a button with id "DAY000000"
function createAvailabilityBtn(id) {
  var formatID = id.replace(/\s|:|-/g, "");
  var param = "'" + formatID + "'";
  var button = '<div class="btn-group animated bounceInDown"><button id="' + formatID + '" class="btn btn-danger btn-group" onclick="removeAvailability(' + param + ')" title="Click to remove">' + 
  id +
  '</button></div>';
  return button;
}