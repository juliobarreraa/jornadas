<?php
/**
 * Jornadas juegos
 * 
 * @package    Joomla.modules
 * @subpackage Modules
 * @link http://www.codebit.com.mx
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );
 
$hello = modJornadasHelper::getHello( $params );
require( JModuleHelper::getLayoutPath( 'mod_jornadas' ) );
?>