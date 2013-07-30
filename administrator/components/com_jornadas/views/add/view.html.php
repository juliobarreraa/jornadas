<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class JornadasViewAdd extends JView
{
	public $form;
    // Overwriting JView display method
    function display($tpl = null) 
    {

    		// Initialise variables
    		$this->state		= $this->get('State');
    		$this->form		= $this->get('Form');
            // Assign data to the view
            $this->msg = $this->get('msg');

            JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
            // Configure the toolbar.
			$this->addToolbar();

			//get the hosts name
			jimport('joomla.environment.uri' );
			$host = JURI::root();
			 
			//add the links to the external files into the head of the webpage (note the 'administrator' in the path, which is not nescessary if you are in the frontend)
			$document =& JFactory::getDocument();
			$document->addScript($host.'administrator/components/com_jornadas/swfupload/swfupload.js');
			$document->addScript($host.'administrator/components/com_jornadas/swfupload/swfupload.queue.js');
			$document->addScript($host.'administrator/components/com_jornadas/swfupload/fileprogress.js');
			$document->addScript($host.'administrator/components/com_jornadas/swfupload/handlers.js');
			$document->addStyleSheet($host.'administrator/components/com_jornadas/swfupload/default.css');

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

		JToolBarHelper::title(JText::_('COM_JORNADAS_ADD_TOOLBAR_TITLE'), 'weblinks');
		$toolbar = JToolBar::getInstance('toolbar');

		$toolbar->appendButton('Link', 'archive', 'COM_JORNADAS_INDEX', 'index.php?option=com_jornadas&view=jornadas', 500, 210);

		JToolBarHelper::divider();

		if ($canDo->get('core.create'))
		{
			JToolBarHelper::Save('add.save');
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