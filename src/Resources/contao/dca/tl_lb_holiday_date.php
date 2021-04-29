<?php

/**
 * Table tl_lb_holiday_date
 */

$GLOBALS['TL_DCA']['tl_lb_holiday_date'] = array
(
    
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'index'
            )
        )
    ),
    
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'       => "int(10) unsigned NOT NULL auto_increment",
        ),
        'date' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_holiday_date']['date'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('rgxp'=>'date', 'datepicker'=>true, 'feViewable'=>true, 'feGroup'=>'personal', 'tl_class'=>'w50 wizard'),
            'sql'       => "varchar(11) NOT NULL default ''"
        ),
        'holiday' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_holiday_date']['holiday'],
            'exclude'   => true,
            'inputType' => 'select',
            'eval'      => array('feViewable'=>true),
            'foreignKey'=> 'tl_lb_holiday_state.id',
            'sql'       => "varchar(64) COLLATE utf8_bin NULL"
        ),
        'weekday' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_holiday_date']['weekday'],
            'exclude'   => true,
            'inputType' => 'select',
            'eval'      => array('feEditable'=>true, 'feViewable'=>true),
            'foreignKey'=> 'tl_lb_location.name',
            'sql'       => "varchar(64) COLLATE utf8_bin NULL"
        ),
        'holiday_id' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_holiday_date']['holiday_id'],
            'exclude'   => true,
            'inputType' => 'select',
            'eval'      => array('feViewable'=>true),
            'foreignKey'=> 'tl_lb_holiday_state.id',
            'relation'  => array('type'=>'belongsTo', 'load'=>'lazy'),
            'sql'       => "int(10) unsigned NOT NULL default '0'",
        ),
        'tstamp' => array
        (
            'sql'       => "int(10) unsigned NOT NULL default '0'"
        )
    )
);