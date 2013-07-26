<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<form action="<?php echo JRoute::_('index.php?option=com_jornadas&view=teams');?>" method="post" name="adminForm" id="adminForm">
		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>
			<li><?php echo $this->form->getLabel('image'); ?>
				<?php echo $this->form->getInput('image'); ?></li>
		</ul>

		<input type="hidden" name="task" value="display" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn ?>" />
		<?php echo JHtml::_('form.token'); ?>
</form>
