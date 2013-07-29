<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_languages
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::script('mod_jornadas/jquery-1.9.1.js', array(), true);
JHtml::script('mod_jornadas/jquery-ui.js', array(), true);

JHtml::_('stylesheet', 'mod_jornadas/jquery-ui.css', array(), true);
JHtml::_('stylesheet', 'mod_jornadas/jquery.ui.tabs.css', array(), true);
JHtml::_('stylesheet', 'mod_jornadas/com_jornadas.css', array(), true);

$document = JFactory::getDocument();
// Add Javascript
$document->addScriptDeclaration('jQuery(function($) {
	$( "#tabs" ).tabs();
});');
?>

<jdoc:include type="message" />
<!-- #tabs -->
<div id="tabs">
	<ul>
	<?php foreach($jornadas as $key => $value): ?>
		<li><a href="#tabs-<?php echo $key ?>"><?php echo $value->getName() ?></a></li>
	<?php endforeach ?>
	</ul>

	<?php foreach($jornadas as $key => $value): ?>
	<div id="tabs-<?php echo $key ?>" class="jornada-scores">
		<ul>
		<?php foreach($value->getTeamsScore() as $teamscore): ?>
			<li><?php echo $teamscore->getFteam()->getName(); ?> - <?php echo $teamscore->getFscore(); ?> | <?php echo $teamscore->getSscore(); ?> - <?php echo $teamscore->getSteam()->getName(); ?></li>
		<?php endforeach ?>
		</ul>
	</div>
	<?php endforeach ?>
</div>
<!-- /#tabs -->