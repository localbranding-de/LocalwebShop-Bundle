<?php

/**
 * Table tl_lb__state
 */

$GLOBALS['TL_DCA']['tl_lb_state'] = array
(
    
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'state_code' => 'index'
            )
        )
    ),
    
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                 => "int(10) unsigned NOT NULL auto_increment",
        ),
        'state' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb__state']['state'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('feViewable'=>true,'tl_class'=>'w50 wizard'),
            'sql'       => "varchar(64) COLLATE utf8_bin NULL" 
        ),
        'state_code' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb__state']['state_code'],
            'exclude'   => true,
            'inputType' => 'select',
            'eval'      => array('feViewable'=>true),
            'sql'       => "varchar(64) COLLATE utf8_bin NULL"
        ),
        'country' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb__state']['country'],
            'exclude'   => true,
            'inputType' => 'select',
            'eval'      => array('feViewable'=>true),
            'sql'       => "varchar(64) COLLATE utf8_bin NULL"
        ),
        'tstamp' => array
        (
            'sql'       => "int(10) unsigned NOT NULL default '0'"
        )
     )
    );