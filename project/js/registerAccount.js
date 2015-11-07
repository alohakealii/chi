function register() {
    var first = document.getElementById('firstName').value;
    var last = document.getElementById('lastName').value;
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    $.ajax({
        type: "POST",
        url: "php/registerAccount.php",
        data: {firstName: first, lastName: last, username: username, password: password},
        success: function () {
            alert("Registration successful!");
            //document.location.href = "index.html";
            window.location = 'availability.php';
        },
        error: function(xhr, status, error) {
            var err = eval( xhr.responseText );
            alert(err.Message);
        }
    });

    
}