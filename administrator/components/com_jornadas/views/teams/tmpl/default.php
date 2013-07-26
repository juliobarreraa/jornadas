<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<form action="<?php echo JRoute::_('index.php?option=com_jornadas&view=jornadas');?>" method="post" name="adminForm" id="adminForm">
		<fieldset id="filter-bar">
			<div class="filter-search fltlft">
				<label class="filter-search-lbl" for="filter_search"><?php echo JText::sprintf('COM_JORNADAS_SEARCH_LABEL', JText::_('COM_JORNADAS_ITEMS')); ?></label>
				<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_JORNADAS_FILTER_SEARCH_DESCRIPTION'); ?>" />
				<button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
				<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
			</div>
			<div class="filter-select fltrt">
				<select name="filter_state" class="inputbox" onchange="this.form.submit()">
					<option value=""><?php echo JText::_('COM_JORNADAS_INDEX_FILTER_BY_STATE');?></option>
					<?php echo JHtml::_('select.options', JHtml::_('jornadas.statelist'), 'value', 'text', $this->state->get('filter.state'));?>
				</select>
				<select name="filter_type" class="inputbox" onchange="this.form.submit()">
					<option value=""><?php echo JText::_('COM_JORNADAS_INDEX_TYPE_FILTER');?></option>
					<?php echo JHtml::_('select.options', JHtml::_('jornadas.typeslist'), 'value', 'text', $this->state->get('filter.type'));?>
				</select>
			</div>
		</fieldset>

		<input type="hidden" name="task" value="display" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn ?>" />
		<?php echo JHtml::_('form.token'); ?>
</form>
