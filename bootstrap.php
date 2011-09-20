<?php

Autoloader::add_core_namespace('Email');

Autoloader::add_classes(array(
	/**
	 * Email classes.
	 */
	'Email\\Email'							=> __DIR__.'/classes/email.php',
	'Email\\Email_Driver'					=> __DIR__.'/classes/email/driver.php',
	'Email\\Email_Driver_Mail'				=> __DIR__.'/classes/email/driver/mail.php',
	'Email\\Email_Driver_SMTP'				=> __DIR__.'/classes/email/driver/smtp.php',
	'Email\\Email_Driver_Sendmail'			=> __DIR__.'/classes/email/driver/sendmail.php',
	
	/**
	 * Email exceptions.
	 */
	'Email\\AttachmentNotFoundException'	=> __DIR__.'/classes/email.php',
	'Email\\InvalidAttachmentsException'	=>  __DIR__.'/classes/email.php',
	'Email\\InvalidEmailStringEncoding'		=>  __DIR__.'/classes/email.php',
));