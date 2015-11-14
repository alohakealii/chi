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
        if (data == true) {
          var button = '<div class="btn-group"><button class="btn btn-danger btn-group" onclick="removeAvailability()" title="Click to remove">' + 
          day + ' ' + time +
          '</button></div>';
          $('#availabilityList').append(button);
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
  }
}

function removeAvailability() {
  
  $(document).on('click', '.btn-danger', function() {
    var dateText = $(this).text();
    var dateRE = new RegExp(/([a-zA-Z]*)\s([0-9]*:[0-9]*\s-\s[0-9]*:[0-9]*)/);
    var split = dateRE.exec(dateText);
    var day = RegExp.$1;
    var time = RegExp.$2;
    //console.log($(this).text())

    $.ajax({
      type: "POST",
      url: "php/removeAvailability.php",
      data: {day: day, time: time},
      success: function (data) {
        if (data == true) {
          alert(data);
          $(this).remove();
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