<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class JornadasViewTeams extends JView
{
	public $form;
    // Overwriting JView display method
    function display($tpl = null) 
    {
    		// Initialise variables
    		$this->form		= $this->get('Form');
            JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
            // Configure the toolbar.
			$this->addToolbar();

            // Display the view
            parent::display($tpl);
    }

	/**
	 * Method to configure the toolbar for this view.
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	protected function addToolbar()
	{
		JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

		$canDo	= JornadasHelper::getActions();

		JToolBarHelper::title(JText::_('COM_JORNADAS_TEAMS_TOOLBAR_TITLE'), 'weblinks');
		$toolbar = JToolBar::getInstance('toolbar');

		JToolBarHelper::divider();

		if ($canDo->get('core.create'))
		{
			JToolBarHelper::Save('teams.save');
			JToolBarHelper::divider();
		}
		if ($canDo->get('core.edit.state'))
		{
			JToolBarHelper::publishList('index.publish');
			JToolBarHelper::unpublishList('index.unpublish');
			JToolBarHelper::divider();
		}
		if ($canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('', 'index.delete');
			JToolBarHelper::divider();
		}
		if ($canDo->get('core.edit.state'))
		{
			JToolBarHelper::trash('index.purge', 'COM_JORNADAS_INDEX_TOOLBAR_PURGE', false);
			JToolBarHelper::divider();
		}

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_jornadas');
		}
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_FINDER_MANAGE_INDEXED_CONTENT');
	}
}