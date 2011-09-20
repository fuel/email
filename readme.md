# Fuel Email classes (as package atm).

A full fledged email class for fuelphp.
At the time of writing only supporting php's native mail function.
Currently working on a SMPT and Sendmail driver.

# Usage

	$mail = Email::forge();
	$mail->from('me@domain.com', 'Your Name Here');
	
	// Set to
	$mail->to('mail@domain.com');
	
	// Set with name
	$mail->to('mail@domain.com', 'His/Her Name');
	
	// Set as arrau
	$mail->to(array(
		// Without name
		'mail@domain.com',
		
		// With name
		'mail@domain.com' => 'His/Her Name',
	));
	
	// Work the same for ->cc and ->bcc and ->reply_to
	
	
	// Set a body message
	$email->body('My email body');
	
	// Set a html body message
	$email->body(\View::forge('email/template', $email_data));
	
	/**
	
		By default this will also generate an alt body from the html,
		and attach any inline files (not paths like http://...)
	
	**/
	
	// Set an alt body
	$email->alt_body('This is my alt body, for non-html viewers.');
	
	// Set a subject
	$email->subject('This is the subject');
	
	// Change the proirity
	$email->proirity(\Email::P_HIGH);
	
	// And send it
	$result = $email->send();


# The result

The send result can be one of three Email class constants.

	+ \Email::SEND - It's a success
	+ \Email::FAILED_VALIDATION - Email validation failed, nothing is send.
	+ \Email::FAILED_SEND - The driver failed at sending the email.
	
# Priorities

These can me one of the following:

	+ \Email::P_LOWEST - 1 (lowest)
	+ \Email::P_LOW - 2 (low)
	+ \Email::P_NORMAL - 3 (normal) - this is the default
	+ \Email::P_HIGH - 4 (high)
	+ \Email::P_HIGHEST - 5 (highest)
	
# That's it. Questions? 