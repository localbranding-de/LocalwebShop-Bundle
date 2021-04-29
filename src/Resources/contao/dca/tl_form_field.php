<?php

/**
 * Table tl_form_field
 */

$GLOBALS['TL_DCA']['tl_form_field']['metapalettes']['lb_calendarfield'] = [
    'type'           => [
        'type',
        'lb_calendarfield',
    ],
    'template'       => [':hide', 'customTpl'],
    'protected'      => [':hide', 'protected'],
];


$GLOBALS['TL_DCA']['tl_form_field']['fields']['lb_calendarfield'] = [
    'label'         => &$GLOBALS['TL_LANG']['tl_form_field']['lb_calendarfield'],
    'exclude'       => true,
    'inputType'     => 'select',
    'options_callback'=>array('lb_ext_Calendar','myOptionsCallback'),
    'eval'          => [
        'includeBlankOption' => true,
        'chosen'             => true,
        'tl_class'           => 'w50'
    ],
    'foreignKey'=> 'tl_calendar.id',
    'relation'   => array('type'=>'belongsTo', 'load'=>'lazy'),
    'sql'       => "int(10) unsigned NOT NULL default '0'",
];



class lb_ext_Calendar extends \Backend
{


   /**
     * Get all calendars and return them as array
     * @return array
     */
    public function myOptionsCallback(DataContainer $dc)
    {

        $values = array();
        $calenders = $this->Database->prepare("SELECT id, title FROM tl_calendar ORDER BY title ASC")->execute();
        //Array erzeugen
        while($calenders->next())
        {
            $values[$calenders->id] = "<b>".$calenders->title."</b>";
        }
        return $values;
    }

}