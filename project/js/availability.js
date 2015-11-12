$(".dropdown-menu li a").click(function(){
  $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
  $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
});

function addAvailability() {
  var userID = 1; // temporary value
  var day = $('#dropdownDay').text().trim();
  var time = $('#dropdownTime').text().trim();

  if (day == "Day" || time == "Time") {
    alert("Please select a day or time");
  }
  else {

    $.ajax({
      type: "POST",
      url: "php/addAvailability.php",
      data: {userID: userID, day: day, time: time},
      success: function (data) {
        var button = '<div class="btn-group"><button class="btn btn-danger btn-group" id="availability-' + data + '" onclick="removeAvailability(' + data + ')" title="Click to remove">' + 
        day + ' ' + time +
        '</button></div>';
        $('#availabilityList').append(button);
      },
      error: function(xhr, status, error) {
        var err = eval( xhr.responseText );
        alert(err.Message);
      }
    });


    
  }
}

function removeAvailability(availabilityID) {
  $("'#availability-" + availabilityID + "'").remove();
  //alert(value);
}