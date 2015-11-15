$(document).ready(function () {
	$.ajax({
		type: "GET",
		url: "php/populateProfile.php",
		success: function(data) {
			console.log(data.toString());
			// document.getElementById('firstName').innerHTML = data[0].firstName;
		},
		error: function(xhr, status, error) {
			var err = eval(xhr.responseText);
			alert(err.Message);
		}
	});

	$("#editProfileBtn").click(function(){
		$("#editProfile").toggle();
	});
});

function updateProfile() {
		var firstName = document.getElementById('firstNameChange').value;
		var lastName = document.getElementById('lastNameChange').value;
		var age = document.getElementById('ageChange').value;
		var gender = document.getElementById('genderChange').value;
		var description = document.getElementById('descriptionChange').value;

		$.ajax({
			type: "POST",
			url: "php/updateProfile.php",
			data: {firstName: firstName,
				lastName: lastName,
				age: age,
				gender: gender,
				description: description},
				success: function (data) {
					console.log(data);
					document.getElementById('firstName').innerHTML = firstName;
					document.getElementById('lastName').innerHTML = lastName;
					document.getElementById('age').innerHTML = age;
					document.getElementById('gender').innerHTML = gender;
					document.getElementById('description').innerHTML = description;

				},
				error: function(xhr, status, error) {
					var err = eval(xhr.responseText);
					alert(err.Message);
				}
			});
	}