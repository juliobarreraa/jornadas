<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
/**
 * Jornadas Model
 */
class JornadasModelJornadas extends JModelItem
{
        /**
         * @var string msg
         */
        protected $msg;

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
        public function getTable($type = 'Jornadas', $prefix = 'JornadasTable', $config = array())
        {
                return JTable::getInstance($type, $prefix, $config);
        }

	public function setMsg($message) {
		$this->msg = $this->getMsg();
	}
 
        /**
         * Get the message
         * @return string The message to be displayed to the user
         */
        public function getMsg() 
        {
                if (!isset($this->msg)) 
                {
                        $this->msg = 'Hello World!';
                }
                return $this->msg;
        }

        /**
         * Devuelve el listado de jornadas creadas
         * @return string[]
         */
        public function getItems() {
                $jornadasTable = $this->getTable();

                $db = $this->getDbo();

                $db->setQuery(
                        'SELECT * from #__jornadas'
                );

                if (!$db->query()) {
                        throw new Exception($db->getErrorMsg());
                }

                return $db->loadObjectList();
        }
}