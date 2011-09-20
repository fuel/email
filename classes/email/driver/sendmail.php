<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Email;

class SendmailConnectionException extends \Fuel_Exception {}

class SendmailFailedException extends \Fuel_Exception {}

class Email_Driver_Sendmail extends \Email_Driver {

	/**
	 * Initalted all needed for Sendmail mailing.
	 *
	 * @return	bool	success boolean
	 */
	protected function _send()
	{
		// Build the message
		$message = $this->build_message();
		
		// Open a connection
		$handle = @popen($this->config['sendmail_path'] . " -oi -f ".$this->config['from']['email']." -t", 'w');

		// No connection?
		if(empty($handle))
		{
			throw new \SendmailConnectionException('Could not open a sendmail connection at: '.$this->config['sendmail_path']);
		}
		
		// Send the headers
		fputs($fp, $message['header']);
		
		// Send the body
		fputs($fp, $message['body']);

		
		$status = pclose($fp) >> 8 & 0xFF;

		if( ! $status)
		{
			throw new \SendmailFailedException('Failed sending email through sendmail.');
		}

		return true;
	}

}