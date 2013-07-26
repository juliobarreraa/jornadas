<?php
/**
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Administrator
 * @subpackage	mod_login
 * @since		1.6
 */
abstract class modJornadasHelper
{
	/**
	 * Get an HTML select list of the available languages.
	 *
	 * @return	string
	 */
	public static function getHello()
	{
		return "Hola mundo";
	}
}
