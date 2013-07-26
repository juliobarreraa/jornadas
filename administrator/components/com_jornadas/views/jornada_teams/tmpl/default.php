<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<form action="<?php echo JRoute::_('index.php?option=com_jornadas&view=jornada_teams');?>" method="post" name="adminForm" id="adminForm">
		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('jornada_id'); ?>
				<?php echo $this->form->getInput('jornada_id'); ?></li>
			<li><?php echo $this->form->getLabel('team_first_id'); ?>
				<?php echo $this->form->getInput('team_first_id'); ?></li>
			<li><?php echo $this->form->getLabel('team_second_id'); ?>
				<?php echo $this->form->getInput('team_second_id'); ?></li>
			<li><?php echo $this->form->getLabel('team_first_score'); ?>
				<?php echo $this->form->getInput('team_first_score'); ?></li>
			<li><?php echo $this->form->getLabel('team_second_score'); ?>
				<?php echo $this->form->getInput('team_second_score'); ?></li>
		</ul>
		<input type="hidden" name="task" value="display" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn ?>" />
		<?php echo JHtml::_('form.token'); ?>
</form>
