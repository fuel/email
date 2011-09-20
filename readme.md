# Fuel Email Package.

A full fledged email class for Fuel.
At the time of writing only supporting php's native mail function.
Currently working on a SMTP and Sendmail driver.

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
	
	// Change the priority
	$email->priority(\Email::P_HIGH);
	
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
	
# Attachments

There are multiple ways to add attachments:

	$email = Email::forge();
	
	// Add an attachment
	$email->attach(DOCROOT.'dir/my_img.png');
	
	// Add an inline attachment
	// Add a cid here to point to the html
	$email->attach(DOCROOT.'dir/my_img.png', true, 'cid:my_conten_id');
	

You can also add string attachments

	$contents = file_get_contents($my_file);
	$email->string_attach($contents, $filename);
	
By default html images are auto included, but it only includes local files.
Look at the following html to see how it works.

	// This is included
	<img src="path/to/my/file.png" />
	
	// This is not included
	<img src="http://remote_host/file.jpeg" />
	
# That's it. Questions? 