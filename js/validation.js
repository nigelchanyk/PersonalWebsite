var submitted = false;

var submitIfValid = function() {
	// Get the form
	var form = $('email_form');
	
	//  if the form is found...
	if (form) {
		// obtain error fields
		var name = document.getElementById('sender');
		var email = document.getElementById('email');
		var title = document.getElementById('title');
		var message = document.getElementById('message');

		// Set the default status
		var isValid = true;

		// Test name length
		if (name.value.length === 0) {
			isValid = false;
			$('#sender_error').html('/* Please enter your name. */');
		} else {
			$('#sender_error').html('');
		}

		// check email length
		if (email.value.length === 0) {
			isValid = false;
			$('#email_error').html('/* Please enter your email address. */');
		// check email validity
		} else if (!/^([a-zA-Z0-9\+_\-]+)(\.[a-zA-Z0-9\+_\-]+)*@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,6}$/.test(email.value)) {
			isValid = false;
			$('#email_error').html('/* Please enter a valid email address. */');
		} else {
			$('#email_error').html('');
		}

		// check comment length
		if (title.value.length === 0) {
			isValid = false;
			$('#title_error').html('/* Please enter the subject of the email. */');
		} else {
			$('#title_error').html('');
		}

		// check comment length
		if (message.value.length === 0) {
			isValid = false;
			$('#message_error').html('/* Please enter your message. */');
		} else {
			$('#message_error').html('');
		}

		// If form invalid then stop event happening
		if (isValid && !submitted) {
			document.forms['email_form'].submit();
			submitted = true;
		}
	}	
}