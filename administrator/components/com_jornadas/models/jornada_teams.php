<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_jornadas
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * Index model class for Finder.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_jornadas
 * @since       2.5
 */
class JornadasModelJornada_teams extends JModelAdmin
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An associative array of configuration settings. [optional]
	 *
	 * @since   2.5
	 * @see     JController
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'published', 'l.published',
				'title', 'l.title',
				'type_id', 'l.type_id',
				'url', 'l.url',
				'indexdate', 'l.indexdate'
			);
		}

		parent::__construct($config);
	}

	/**
	 * Returns a JTable object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate. [optional]
	 * @param   string  $prefix  A prefix for the table class name. [optional]
	 * @param   array   $config  Configuration array for model. [optional]
	 *
	 * @return  JTable  A database object
	 *
	 * @since   2.5
	 */
	public function getTable($type = 'Jornada_teams', $prefix = 'JornadasTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}


	/**
	 * Method to get the group form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 *
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_jornadas.jornada_teams', 'jornada_teams', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to delete a node and, optionally, its child nodes from the table.
	 *
	 * @param   integer  $pk        The primary key of the node to delete.
	 * @param   boolean  $children  True to delete child nodes, false to move them up a level.
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     http://docs.joomla.org/JTableNested/delete
	 * @since   2.5
	 */
	public function delete($pk = null, $children = false)
	{
		return parent::delete($pk, $children);
	}


    /**
     * Devuelve el listado de jornadas creadas
     * @return string[]
     */
    public function getItems() {
            $teamsTable = $this->getTable();

            $db = $this->getDbo();

            $db->setQuery(
                    'SELECT * from #__jornada_teams'
            );

            if (!$db->query()) {
                    throw new Exception($db->getErrorMsg());
            }

            return $db->loadObjectList();
    }
}
