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
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Email;


class Email_Driver_Mailgun extends \Email_Driver
{

    protected function _send()
    {
        $message = $this->build_message();

        $mg = new \Mailgun\Mailgun($this->config['mailgun']['key']);

        $post_data = array(
            'from'=> $this->config['from']['email'],
            'to' => static::format_addresses($this->to),
            'subject' => $this->subject,
            'html' => $message['body'],
            'header' => $message['header']
        );

        $mg->sendMessage($this->config['mailgun']['domain'], $post_data);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function html_body($body, $generate_alt = null, $auto_attach = null)
    {
        $this->body = (string) $body;

        return $this;
    }

}
