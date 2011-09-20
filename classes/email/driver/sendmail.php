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


class Email_Driver_Sendmail extends \Email_Driver {

	/**
	 * Initalted all needed for Sendmail mailing.
	 *
	 * @return	bool	success boolean
	 */
	protected function _send()
	{
		return false;
	}

}