$(init);

function init() {
    $("#tabs").tabs();
    $("#checkAvailability").button()

    $( "#slider" ).slider({
      range: "max",
      min: 1,
      max: 100,
      value: 1,
      slide: function( event, ui ) {
        $( "#ageInput" ).val( ui.value );
      }
    });
    $( "#ageInput" ).val( $( "#slider" ).slider( "value" ) );

    $('#regform').submit( // catch the form's submit event
        function() {
            $.ajax({
                data: $(this).serialize(), // get the form data
                type: $(this).attr('method'), // GET or POST
                url: $(this).attr('action'), // the file to call
                success: function(response) { // on success..
                    $('#register').html(response); // update the DIV
                    $('#backBtn').button()
                }
            });
            return false; // cancel original event to prevent form submitting
        }
    );

    $('#searchform').submit( // catch the form's submit event
        function() {
            $.ajax({
                data: $(this).serialize(), // get the form data
                type: $(this).attr('method'), // GET or POST
                url: $(this).attr('action'), // the file to call
                success: function(response) { // on success..
                    $('#preparedStatements').html(response); // update the DIV
                    $('#backBtn').button()
                }
            });
            return false; // cancel original event to prevent form submitting
        }
    );

    $('#lostusrnmform').submit( // catch the form's submit event
        function() {
            $.ajax({
                data: $(this).serialize(), // get the form data
                type: $(this).attr('method'), // GET or POST
                url: $(this).attr('action'), // the file to call
                success: function(response) { // on success..
                    $('#preparedStatements').html(response); // update the DIV
                    $('#backBtn').button()
                }
            });
            return false; // cancel original event to prevent form submitting
        }
    );

    $('#availform').submit( // catch the form's submit event
        function() {
            $.ajax({
                data: $(this).serialize(), // get the form data
                type: $(this).attr('method'), // GET or POST
                url: $(this).attr('action'), // the file to call
                success: function(response) { // on success..
                    $('#preparedStatements').html(response); // update the DIV
                    $('#backBtn').button()
                }
            });
            return false; // cancel original event to prevent form submitting
        }
    );
}

$("#sidebarContent").click(toggleSidebarFeline);
$("#register").click(toggleRegistration);
$("#preparedstatements").click(togglePreparedStatements);

var toggleSidebar = true;
var toggleRegistration = true;
var togglePreparedStatements = true;

function validateName() {
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;

    var nameRE = /^[a-zA-Z]+$/;
    if (!firstName.match(nameRE) || !lastName.match(nameRE)) {
        alert("Invalid search: letters only!");
        return false;
    }
}

function regBack() {
    $("#register").html('\
        <h2>Registration</h2>\
        <form action="verify.php" method="post" id="regform">\
            <fieldset>\
                <p>\
                    <label>First name:</label>\
                    <input name="firstName" type="text" value="Betty"/>\
                </p>\
                <p>\
                    <label>Last name:</label>\
                    <input name="lastName" type="text" value="Smith"/>\
                </p>\
                <p>\
                    Gender:\
                    <select name="gender">\
                        <option value="both">Select</option>\
                        <option value="male">Male</option>\
                        <option value="female">Female</option>\
                    </select>\
                </p>\
                <p>\
                    Age:\
                    <input type="radio" name="ageControl" value=">"/> Greater than\
                    <input type="radio" name="ageControl" value="<"/> Less than\
                    <input name="age" id="ageInput" type="text"/>\
                    <div id="slider"></div>\
                </p>\
                <button type="submit">Submit</button>\
            </fieldset>\
        </form>');
    init();
}

function preparedBack() {
    $("#preparedStatements").html('\
        <h2>Prepared SQL Statements</h2>\
        <form action="avail.php" method="post" id="availform">\
            <button type="submit" id="checkAvailability">Check Availability</button>\
        </form><br />\
        <form action="lostusrnm.php" method="post" id="lostusrnmform" onsubmit="return validateName()">\
            <fieldset class="ui-widget ui-corner-all">\
                <legend>Lost Username</legend>\
                <p>\
                    <label>First Name</label>\
                    <input type="text" name="firstName" value="Betty" id="firstName"/>\
                </p>\
                <p>\
                    <label>Last Name</label>\
                    <input type="text" name="lastName" value="Smith" id="lastName"/>\
                </p>\
                <button type="submit">Submit</button>\
            </fieldset>\
        </form><br />\
        <form action="searchusrs.php" method="post" id="searchform">\
            <fieldset class="ui-widget ui-corner-all">\
                <legend>Search Users</legend>\
                <p>\
                    <label>Age Less Than</label>\
                    <input type="number" name="age" value="50"/>\
                </p>\
                <p>\
                    <label>Available After</label>\
                    <input type="number" name="startTime" value="3" min="1" max="24"/>\
                </p>\
            <button type="submit">Submit</button>\
        </fieldset>\
        </form>');
    init();
}

function toggleSidebarFeline() {
    var sidebar ='\
        <p><a href="index.html">Home</a></p>\
        <p><a href="cube.html">Animation</a></p>\
        <p><a href="draw.html">Draw</a></p>\
        <p><a href="#">Locations</a></p>\
        <p><a href="#">Search</a></p>\
        <p><a href="#">User Directory</a></p>\
        <p><a href="#">Site map</a></p>';
    var kitty = '\
        <img src="http://www.roflcat.com/images/cats/Cats_funny_costume.jpg" />\
        <p> This is one rockin Metallicat!</p>';

    if (toggleSidebar == true) {
        var output = kitty;
        toggleSidebar = false;
    }
    else {
        var output = sidebar;
        toggleSidebar = true
    }
    $("#sidebarContent").html(output);
}

function showRegistration() {
    var text = '\
        <form action="verify.php" method="post">\
            <fieldset>\
                <p>\
                    <label>First name:</label>\
                    <input name="firstName" type="text" value="Betty"/>\
                </p>\
                <p>\
                    <label>Last name:</label>\
                    <input name="lastName" type="text" value="Smith"/>\
                </p>\
                <p>\
                    Gender:\
                    <select name="gender">\
                        <option value="both">Select</option>\
                        <option value="male">Male</option>\
                        <option value="female">Female</option>\
                    </select>\
                </p>\
                <p>\
                    Age:\
                    <input type="radio" name="ageControl" value=">"/> Greater than\
                    <input type="radio" name="ageControl" value="<"/> Less than\
                    <input name="age" type="text"/>\
                </p>\
                <input type="submit" value="Submit" />\
            </fieldset>\
        </form>';
    if (toggleRegistration == true) {
        toggleRegistration = false;
    }
    else {
        text = '';
        toggleRegistration = true;
    }
    $("#register").html(text);
}

function showPreparedStatements() {
    var text = '\
        <form action="avail.php" method="post">\
            <input type="submit" value="Check Availability"/>\
        </form>\
        <form action="lostusrnm.php" method="post" onsubmit="return validateName()">\
            <fieldset>\
                <p>\
                    <label>First Name</label>\
                    <input type="text" name="firstName" value="Betty" id="firstName"/>\
                </p>\
                <p>\
                    <label>Last Name</label>\
                    <input type="text" name="lastName" value="Smith" id="lastName"/>\
                </p>\
                <input type="submit" value="submit" />\
            </fieldset>\
        </form>\
        <form action="searchusrs.php" method="post">\
            <fieldset>\
                <p>\
                    <label>Age Less Than</label>\
                    <input type="number" name="age" value="50"/>\
                </p>\
                <p>\
                    <label>Available After</label>\
                    <input type="number" name="startTime" value="3" min="1" max="24"/>\
                </p>\
            <input type="submit" value="submit"/>\
        </fieldset>\
        </form>';
    if (togglePreparedStatements == true) {
        togglePreparedStatements = false;
    }
    else {
        text = '';
        togglePreparedStatements = true;
    }
    $("#preparedstatements").html(text);
}