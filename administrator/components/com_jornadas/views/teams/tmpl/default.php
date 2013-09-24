<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
$user		= JFactory::getUser();
?>
<form action="<?php echo JRoute::_('index.php?option=com_jornadas&view=teams');?>" method="post" name="adminForm" id="adminForm">
		<fieldset id="filter-bar">
			<div class="filter-search fltlft">
				<label class="filter-search-lbl" for="filter_search"><?php echo JText::sprintf('COM_JORNADAS_SEARCH_LABEL', JText::_('COM_JORNADAS_ITEMS')); ?></label>
				<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_JORNADAS_FILTER_SEARCH_DESCRIPTION'); ?>" />
				<button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
				<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
			</div>
		</fieldset>

	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				</th>
				<th>
					<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
				</th>
				<th width="5%">
					<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
				</th>
				<th width="10%">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ORDERING', 'a.lft', $listDirn, $listOrder); ?>
					<?php if ($saveOrder) :?>
						<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'categories.saveorder'); ?>
					<?php endif; ?>
				</th>
				<th width="10%">
					<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ACCESS', 'a.title', $listDirn, $listOrder); ?>
				</th>
				<th width="1%" class="nowrap">
					<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="15">
					<?php //echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php
			$originalOrders = array();
			foreach ($this->items as $i => $item) :
				//$orderkey	= array_search($item->id, $this->ordering[$item->parent_id]);
				$canEdit	= $user->authorise('core.edit',			$extension.'.category.'.$item->id);
				$canCheckin	= $user->authorise('core.admin', 'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
				$canEditOwn	= $user->authorise('core.edit.own',		$extension.'.category.'.$item->id) && $item->created_user_id == $userId;
				$canChange	= $user->authorise('core.edit.state',	$extension.'.category.'.$item->id) && $canCheckin;
			?>
				<tr class="row<?php echo $i % 2; ?>">
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<td>
						<?php if ($item->checked_out) : ?>
							<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'categories.', $canCheckin); ?>
						<?php endif; ?>
						<?php if ($canEdit || $canEditOwn) : ?>
							<a href="<?php echo JRoute::_('index.php?option=com_jornadas&task=teams.edit&id='.$item->id.'&extension='.$extension);?>">
								<?php echo $this->escape($item->name); ?></a>
						<?php else : ?>
							<?php echo $this->escape($item->name); ?>
						<?php endif; ?>
					</td>
					<td class="center">
						<?php echo JHtml::_('jgrid.published', $item->published, $i, 'teams.', $canChange);?>
					</td>
					<td class="order">
						<?php if ($canChange) : ?>
							<?php if ($saveOrder) : ?>
								<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, isset($this->ordering[$item->parent_id][$orderkey + 1]), 'teams.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
							<?php endif; ?>
							<?php $disabled = $saveOrder ?  '' : 'disabled="disabled"'; ?>
							<input type="text" name="order[]" size="5" value="<?php echo $orderkey + 1;?>" <?php echo $disabled ?> class="text-area-order" />
							<?php $originalOrders[] = $orderkey + 1; ?>
						<?php else : ?>
							<?php echo $orderkey + 1;?>
						<?php endif; ?>
					</td>
					<td class="center">
						<?php echo $this->escape($item->access_level); ?>
					</td>
					</td>
					<td class="center">
						<span title="<?php echo sprintf('%d-%d', $item->lft, $item->rgt);?>">
							<?php echo (int) $item->id; ?></span>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
		<input type="hidden" name="task" value="display" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn ?>" />
		<?php echo JHtml::_('form.token'); ?>
</form>
