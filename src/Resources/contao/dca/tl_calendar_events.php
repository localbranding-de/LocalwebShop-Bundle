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

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['bought'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_calendar_events']['bought'],
    'sql'       => "char(1) NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['updated'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_calendar_events']['updated'],
    'sql'                     => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['order'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_calendar_events']['order'],
    'sql'                     => "int(10) unsigned NOT NULL default '0'"
);
