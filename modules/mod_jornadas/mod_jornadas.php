<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_jornadas
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$jornadas = modJornadasHelper::getList($params);

require JModuleHelper::getLayoutPath('mod_jornadas', $params->get('layout', 'default'));
