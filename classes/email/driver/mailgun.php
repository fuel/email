<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2014 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Email;


class Email_Driver_Mailgun extends \Email_Driver
{

	protected function _send()
	{
		$message = $this->build_message();

		$mg = new \Mailgun\Mailgun($this->config['mailgun']['key']);

		// Mailgun does not consider these "arbitrary headers"
		$exclude = array('From'=>'From', 'To'=>'To', 'Cc'=>'Cc', 'Bcc'=>'Bcc', 'Subject'=>'Subject', 'Content-Type'=>'Content-Type', 'Content-Transfer-Encoding' => 'Content-Transfer-Encoding');
		$headers = array_diff_key($this->headers, $exclude);

		foreach ($this->extra_headers as $header => $value)
		{
			$headers[$header] = $value;
		}

		// Standard required fields
		$post_data = array(
			'from'=> $this->config['from']['email'],
			'to' => static::format_addresses($this->to),
			'subject' => $this->subject,
		);

		// Optionally cc and bcc
		$this->cc and $post_data['cc'] = static::format_addresses($this->cc);
		$this->bcc and $post_data['bcc'] = static::format_addresses($this->bcc);

		// Mailgun's "arbitrary headers" are h: prefixed
		foreach ($headers as $name => $value)
		{
			$post_data["h:{$name}"] = $value;
		}

		// Add the attachments
		$post_body = array(
			'message' => array(),
			'attachment' => array(),
			'inline' => array(),
		);

		foreach ($this->attachments['attachment'] as $cid => $file)
		{
			$post_body['attachment'][] = array('filePath' => $file['file'][0], 'remoteName' => $file['file'][1]);
		}

		foreach ($this->attachments['inline'] as $cid => $file)
		{
			$post_body['inline'][] = array('filePath' => $file['file'][0], 'remoteName' => $file['file'][1]);
		}

		$tempFile = tempnam(sys_get_temp_dir(), "MG_TMP_MIME");
		$fileHandle = fopen($tempFile, "w");
		fwrite($fileHandle, $message['body']);
		fclose($fileHandle);
		$post_body['message'][] = $tempFile;

		$mg->sendMessage($this->config['mailgun']['domain'], $post_data, $post_body);

		unlink($tempFile);

		return true;
	}
}
