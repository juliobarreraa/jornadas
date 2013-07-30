<form action="<?php echo JRoute::_('index.php?option=com_jornadas&view=add');?>" method="post" name="adminForm" id="adminForm">
	<div class="clr"> </div>
	
	<ul class="adminformlist">
		<li><?php echo $this->form->getLabel('name'); ?>
			<?php echo $this->form->getInput('name'); ?></li>
	</ul>
	<input type="hidden" name="task" value="display" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $listOrder ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn ?>" />
	<?php echo JHtml::_('form.token'); ?>
</form>
