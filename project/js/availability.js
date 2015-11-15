$(".dropdown-menu li a").click(function(){
  $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
  $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
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
          var id = (day + time).replace(/ /g, "");
          id = id.replace(/\s|:|-/g, "");
          var param = "'" + id + "'";
          var button = '<div class="btn-group"><button id="' + id + '" class="btn btn-danger btn-group" onclick="removeAvailability(' + param + ')" title="Click to remove">' + 
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
          button.parent().remove();
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