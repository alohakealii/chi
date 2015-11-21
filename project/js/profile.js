function populateProfile() {
	var response = $.ajax({
		type: "POST",
		url: "php/populateProfile.php",
		success: function(data){
			var name = data[0]["firstName"] + " " + data[0]["lastName"];
			document.getElementById('name').innerHTML= name;
			document.getElementById('firstName').innerHTML= data[0]["firstName"];
			document.getElementById('lastName').innerHTML= data[0]["lastName"];
			document.getElementById('age').innerHTML= data[0]["age"];
			document.getElementById('gender').innerHTML= data[0]["gender"];
			document.getElementById('description').innerHTML= data[0]["description"];

			document.getElementById('firstNameChange').value = data[0]["firstName"];
			document.getElementById('lastNameChange').value = data[0]["lastName"];
			document.getElementById('ageChange').value = data[0]["age"];
			document.getElementById('genderChange').value = data[0]["gender"];
			document.getElementById('descriptionChange').value = data[0]["description"];
		}
	});
}

$("#editProfileBtn").click(function() {
	$("#updateProfileModal").modal();
});

$("#submitChanges").click(function() {
	$("#updateProfileModal").modal('hide');
});

function updateProfile() {
	var firstName = document.getElementById('firstNameChange').value
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
				var name = firstName + " " + lastName;
				document.getElementById('name').innerHTML = name;
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