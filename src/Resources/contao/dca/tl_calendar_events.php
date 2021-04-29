<?php 

/**
 * Table tl_calendar_events
 */

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['approved'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_calendar_events']['approved'],
    'exclude'   => true,
    'inputType' => 'select',
    'eval'      => array('tl_class'=>'w50'),
    'default' => 1,
 	'sql'       => "char(1) NOT NULL default ''"
);