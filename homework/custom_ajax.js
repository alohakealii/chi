$(document).ready(function() {
	$('#searchform').submit(
		function() {
			$.ajax({
				data: $(this).serialize(),
				type: $(this).attr('method'),
				url: $(this).attr('action'),
				success: function(response) {
					$('#found').html(response);
				}
			});
			return false;
		});
});



// $('#create').submit(function() { // catch the form's submit event
//     $.ajax({ // create an AJAX call...
//         data: $(this).serialize(), // get the form data
//         type: $(this).attr('method'), // GET or POST
//         url: $(this).attr('action'), // the file to call
//         success: function(response) { // on success..
//             $('#created').html(response); // update the DIV
//         }
//     });
//     return false; // cancel original event to prevent form submitting
// });