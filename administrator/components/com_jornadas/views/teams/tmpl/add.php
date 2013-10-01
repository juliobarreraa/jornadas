<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.environment.uri' );
$document =& JFactory::getDocument();

//when we send the files for upload, we have to tell Joomla our session, or we will get logged out 
$session = & JFactory::getSession();
 
$swfUploadHeadJs ='
		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "'.$host.'components/com_jornadas/swfupload/swfupload.swf",
				flash9_url : "'.$host.'components/com_jornadas/swfupload/swfupload_fp9.swf",
				upload_url: "index.php",
				post_params: {"PHPSESSID" : "<?php echo session_id(); ?>", "option" : "com_jornadas", "view" : "upload", "id": "'.$myItemObject->id.'", "'.$session->getName().'" : "'.$session->getId().'", "format" : "raw"},

				file_size_limit : "100 MB",
				file_types : "*.*",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "'.$host.'components/com_jornadas/swfupload/images/TestImageNoText_65x29.png",
				button_width: "65",
				button_height: "29",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: "<span class=\"theFont\">Subir</span>",
				button_text_style: ".theFont { font-size: 16; }",
				button_text_left_padding: 12,
				button_text_top_padding: 3,
				
				// The event handler functions are defined in handlers.js
				swfupload_preload_handler : preLoad,
				swfupload_load_failed_handler : loadFailed,
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	     }; 
';
 
//add the javascript to the head of the html document
$document->addScriptDeclaration($swfUploadHeadJs);

?>
<form action="<?php echo JRoute::_('index.php?option=com_jornadas&view=teams');?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
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
