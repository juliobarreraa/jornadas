<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Index controller class for Finder.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_finder
 * @since       2.5
 */
class JornadasControllerTeams extends JControllerForm
{
	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 *
	 * @since   2.5
	 */
	public function getModel($name = 'Teams', $prefix = 'JornadasModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	/**
	 * Method to save a record.
	 *
	 * @param   string  $key     The name of the primary key of the URL variable. [optional]
	 * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions). [optional]
	 *
	 * @return  boolean  True if successful, false otherwise.
	 *
	 * @since   2.5
	 */
	public function save($key = null, $urlVar = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication();
		$input = $app->input;
		$lang = JFactory::getLanguage();
		$model = $this->getModel();
		$table = $model->getTable();
		$data = $input->post->get('jform', array(), 'array');
		$context = "$this->option.create.$this->context";
		$task = $this->getTask();

		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

	    //import joomlas filesystem functions, we will do all the filewriting with joomlas functions,
	    //so if the ftp layer is on, joomla will write with that, not the apache user, which might
	    //not have the correct permissions
	    jimport('joomla.filesystem.file');
	    jimport('joomla.filesystem.folder');
	     
	    //this is the name of the field in the html form, filedata is the default name for swfupload
	    //so we will leave it as that
	    $fieldName = 'jform';
	     
	    //any errors the server registered on uploading
	    $fileError = $_FILES["jform"]['error'];

	    if ($fileError > 0) 
	    {
	            switch ($fileError) 
	            {
	            case 1:
	            $app->enqueueMessage('Archivo más grande de lo que php.ini permite', 'error');
	            $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $this->getRedirectToListAppend(), false));
	     
	            case 2:
	            $app->enqueueMessage('Archivo más grande de lo permitido', 'error');
	            $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $this->getRedirectToListAppend(), false));
	     
	            case 3:
	            $app->enqueueMessage('Error al subir', 'error');
	            $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $this->getRedirectToListAppend(), false));
	     
	            case 4:
	            $app->enqueueMessage('Sin archivo', 'error');
	            $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $this->getRedirectToListAppend(), false));
	            }
	    }

	    //check for filesize
	    $fileSize = $_FILES[$fieldName]['size'];

	    if((int)$fileSize > 2000000)
	    {
	            $app->enqueueMessage('El archivo tiene un peso superior a 2M', 'error');
	            $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $this->getRedirectToListAppend(), false));
	    }
	     
	    //check the file extension is ok
	    $fileName = $_FILES[$fieldName]['name']['image'];

	    $uploadedFileNameParts = explode('.', $fileName);
	    $uploadedFileExtension = array_pop($uploadedFileNameParts);

	     
	    $validFileExts = explode(',', 'jpeg,jpg,png,gif');
	     
	    //assume the extension is false until we know its ok
	    $extOk = false;
	    //go through every ok extension, if the ok extension matches the file extension (case insensitive)
	    //then the file extension is ok
	    foreach($validFileExts as $key => $value)
	    {
	            if( preg_match("/$value/i", $uploadedFileExtension ) )
	            {
	                    $extOk = true;
	            }
	    }
	     
	    if ($extOk == false) 
	    {
	            $app->enqueueMessage('Invalid extension', 'error');
	            $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $this->getRedirectToListAppend(), false));
	    }
	    //the name of the file in PHP's temp directory that we are going to move to our folder
	    $fileTemp = $_FILES[$fieldName]['tmp_name'];
	     
	    //for security purposes, we will also do a getimagesize on the temp file (before we have moved it 
	    //to the folder) to check the MIME type of the file, and whether it has a width and height
	    $imageinfo = getimagesize($fileTemp['image']);

	     
	    //we are going to define what file extensions/MIMEs are ok, and only let these ones in (whitelisting), rather than try to scan for bad
	    //types, where we might miss one (whitelisting is always better than blacklisting) 
	    $okMIMETypes = 'image/jpeg,image/pjpeg,image/png,image/x-png,image/gif';
	    $validFileTypes = explode(",", $okMIMETypes);           
	     
	    //if the temp file does not have a width or a height, or it has a non ok MIME, return
	    if( !is_int($imageinfo[0]) || !is_int($imageinfo[1]) ||  !in_array($imageinfo['mime'], $validFileTypes) )
	    {
	            $app->enqueueMessage('Invalid file name', 'error');
	            $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $this->getRedirectToListAppend(), false));
	    }
	     
	    //lose any special characters in the filename
	    $fileName = preg_replace("/[^A-Za-z0-9]/i", ".", $fileName);
	     
	    //always use constants when making file paths, to avoid the possibilty of remote file inclusion
	    $uploadPath = JPATH_SITE.DS.'images'.DS.'jornadas'.DS.$fileName;

	    if(!JFile::upload($fileTemp['image'], $uploadPath)) 
	    {
	            $app->enqueueMessage('Error moving file', 'error');
	            $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $this->getRedirectToListAppend(), false));
	    }
	    
	    $data['image'] = $fileName;



		// Determine the name of the primary key for the data.
		if (empty($key))
		{
			$key = $table->getKeyName();
		}

		// To avoid data collisions the urlVar may be different from the primary key.
		if (empty($urlVar))
		{
			$urlVar = $key;
		}

		$recordId = $input->get($urlVar, '', 'int');

		$session = JFactory::getSession();
		$registry = $session->get('registry');

		// Populate the row id from the session.
		$data[$key] = $recordId;

		// Access check.
		if (!$this->allowSave($data, $key))
		{
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_SAVE_NOT_PERMITTED'));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $this->getRedirectToListAppend(), false));

			return false;
		}

		// Validate the posted data.
		// Sometimes the form needs some posted data, such as for plugins and modules.
		$form = $model->getForm($data, false);

		if (!$form)
		{
			$app->enqueueMessage($model->getError(), 'error');

			return false;
		}

		// Test whether the data is valid.
		$validData = $model->validate($form, $data);

		// Check for validation errors.
		if ($validData === false)
		{
			// Get the validation messages.
			$errors = $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
			{
				if (($errors[$i]) instanceof Exception)
				{
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				}
				else
				{
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}
			// Save the data in the session.
			$app->setUserState($context . '.data', $data);

			// Redirect back to the edit screen.
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_item . $this->getRedirectToItemAppend($recordId, $key), false));

			return false;
		}

		// Attempt to save the data.
		if (!$model->save($validData))
		{
			// Save the data in the session.
			$app->setUserState($context . '.data', $validData);

			// Redirect back to the edit screen.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_item . $this->getRedirectToItemAppend($recordId, $key), false));

			return false;
		}

		$this->setMessage(
			JText::_(
				($lang->hasKey($this->text_prefix . ($recordId == 0 && $app->isSite() ? '_SUBMIT' : '') . '_SAVE_SUCCESS')
				? $this->text_prefix : 'JLIB_APPLICATION') . ($recordId == 0 && $app->isSite() ? '_SUBMIT' : '') . '_SAVE_SUCCESS'
			)
		);
		$this->setRedirect('index.php?option=com_jornadas&view=teams');

		return true;
	}


	/**
	 * Borra un equipo
	 * @return
	 */
	public function delete() {
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Get the model.
		$model = $this->getModel();

		// Load the filter state.
		$app = JFactory::getApplication();

		$user	= JFactory::getUser();

		$ids = JRequest::getVar('cid', array(), 'post', 'array');

		$model->setState('list.limit', 0);
		$model->setState('list.start', 0);

		// Access checks.
		foreach ($ids as $i => $id)
		{
			if (!$user->authorise('core.delete', 'com_jornadas.teams.'.(int) $id))
			{
				// Prune items that you can't delete.
				unset($ids[$i]);
				JError::raiseNotice(403, JText::_('JERROR_CORE_DELETE_NOT_PERMITTED'));
			} else {
				// Get the model.
				$model = $this->getModel();

				// Remove the items.
				if (!$model->delete($id)) {
					JError::raiseWarning(500, $model->getError());
				}
			}
		}

		$this->setRedirect('index.php?option=com_jornadas&view=teams');
	}

	public function edit() {
		// Initialise variables.
		$app		= JFactory::getApplication();
		$model		= $this->getModel();
		$recordId	= JRequest::getVar('id');
		$context	= 'com_jornadas.edit.teams';

		// Access check.
		if (!$this->allowEdit()) {
			return JError::raiseWarning(403, JText::_('JLIB_APPLICATION_ERROR_EDIT_NOT_PERMITTED'));
		}

		// Check-out succeeded, push the new record id into the session.
		$app->setUserState($context.'.id',	$recordId);
		$app->setUserState($context.'.data', null);
		$this->setRedirect('index.php?option=com_jornadas&view=teams&layout=edit');
		return true;
	}
}
