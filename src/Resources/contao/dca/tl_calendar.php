<?php

/**
 * Table tl_calendar
 */

$GLOBALS['TL_DCA']['tl_calendar']['palettes']['default'] = str_replace('{extended_legend}','{lb_legend},lb_calendartype;{extended_legend}',$GLOBALS['TL_DCA']['tl_calendar']['palettes']['default']);



// Hinzufügen der Feld-Konfiguration

$GLOBALS['TL_DCA']['tl_calendar']['fields']['lb_calendartype'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_calendar']['lb_calendartype'],
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => array("Mitarbeiterkalender","Standortskalender"),
    'eval'      => array('feEditable'=>true, 'feViewable'=>true),
    'sql'       => "varchar(64) COLLATE utf8_bin NULL" 
);