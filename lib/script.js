$(document).ready(function() {
	$('#divSubmitButton').click(processForm);
});

function processForm() {
	var response;
	$.ajax({
		type: 'POST',
		url: 'process.php',
		data: { fname: $('#fname').val(),
				lname: $('#lname').val(),
				message: $('#message').val()
			  },
		success: function(data) {
			response = JSON.parse(data);
			if(response.code == 0) {
				$('.error').remove();
				$('<p class="error"></p>').insertAfter('h1').text(response.message);
			} else if(response.code == 1) {
				$('.error').remove();
				$('form').replaceWith('<p class="success">' + response.message + '</p>');
			} else  {
				alert('What?');
			}
		}
	});
}