$(document).ready(function () {
	
	function populateProfile(){
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

			}
		});
	}
	
	$("#editProfileBtn").click(function(){
		$("#editProfile").toggle();
	});
	populateProfile();
});

function forGuest() {
	var firstName = document.getElementById('firstName').innerHTML;
	var lastName = document.getElementById('lastName').innerHTML;
	var age = document.getElementById('age').innerHTML;
	var gender = document.getElementById('gender').innerHTML;
	var description = document.getElementById('description').innerHTML;
	
	var response = $.ajax({
		type: "POST",
		url: "php/checkForGuest.php",
		data: {firstName: firstName,
			lastName: lastName,
			age: age,
			gender: gender,
			description: description},
		success: function(data){
			if(data == false){
				$("#editProfileBtn").hide();
				document.getElementById('editProfileBtn').hide();
			}
			
		},
		error: function(xhr, status, error){
			var err = eval(xhr.responseText);
			alert(err.Message);
		}
	});
	//$("#editProfileBtn").hide();
	//document.getElementById('editProfileBtn').hide();
}

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
					var name = firstName + " " + lastName;
					document.getElementById('firstName').innerHTML = name;
					//document.getElementById('lastName').innerHTML = lastName;
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