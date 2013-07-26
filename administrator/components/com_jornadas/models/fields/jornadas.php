<?php
// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type

jimport('joomla.form.helper');
jimport( 'joomla.form.fields.combo' );

JFormHelper::loadFieldClass('combo');
 
/**
 * SancaManager Form Field class for the SancaManager component
 */
class JFormFieldJornadas extends JFormFieldCombo
{
    /**
     * The field type.
     *
     * @var        string
     */
    public $type = 'jornadas';

    public function getInput() {
        $select = '<select id="'.$this->id.'" name="'.$this->name.'">{content}</select>';

        $options = '';

        foreach($this->getOptions() as $option) {
            $options .= "<option value='{$option->value}'>{$option->text}</option>";
        }

        return preg_replace('/{content}/i', $options, $select);
    }
 
    /**
     * Method to get a list of options for a list input.
     *
     * @return    array        An array of JHtml options.
     */

    protected function getOptions() 
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);

        $query->select('j.id, j.name')
              ->from('#__jornadas j');

        $db->setQuery((string)$query);

        $stagioni = $db->loadObjectList();

        $options = array();

        if ($stagioni)
        {
            foreach($stagioni as $stagione) 
            {
                $options[] = JHtml::_('select.option', $stagione->id, $stagione->name);

            }
        }
        $options = array_merge(parent::getOptions(), $options);
        return $options;
    }
}
?>