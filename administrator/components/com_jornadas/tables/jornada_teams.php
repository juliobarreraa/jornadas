<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

/**
 * Filter table class for the Finder package.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_jornadas
 * @since       2.5
 */
class JornadasTableJornada_teams extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   object  &$db  JDatabase connector object.
	 *
	 * @since   2.5
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__jornada_teams', 'id', $db);
	}
}
