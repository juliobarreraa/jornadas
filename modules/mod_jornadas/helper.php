<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_jornadas
 */

// no direct access
defined('_JEXEC') or die;

abstract class modJornadasHelper
{
	/**
	 * Listado de juegos agrupados por jornadas
	 * @param  JRegistry $params
	 * @return Jornadas[]
	 */
	public static function getList(&$params)
	{
		//Obtenemos listado de jornadas a mostrar
		$items = $params->get('jornadas', array());

		//Si selecciono jornadas entonces se muestra en otro caso mostramos un error
		if(!(is_array($items) && count($items))) {
			JError::raiseNotice( 100, JText::_('MODULE_JORNADAS_NO_JORNADAS') );
			return;
		}

		require_once dirname(__FILE__).'/jornadas/Jornadas.php';
		/**
		 * Jornadas
		 * @var Jornadas
		 */
		$jornadas = new Jornadas;

		/** array $items as string $key => string $value */
		foreach($items as $key => $value) {
			require_once dirname(__FILE__).'/jornadas/Jornada.php';

			//Agregamos la primera jornada
			$jornada = new Jornada($value);
			$jornadas->add($jornada);
		}

		return $jornadas->getJornadas();
	}
}
