<?php

/**
 * Table tl_lb_holiday_state
 */

$GLOBALS['TL_DCA']['tl_lb_holiday_state'] = array
(
    
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
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
        'holiday' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_holiday_state']['date'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('rgxp'=>'date', 'datepicker'=>true, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'personal', 'tl_class'=>'w50 wizard'),
            'sql'       => "varchar(11) NOT NULL default ''"
        ),
        'BW' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['BW'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'BY' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['BY'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'BE' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['BE'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'BB' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['BB'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'HB' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['HB'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'HH' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['HH'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'HE' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['HE'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'MV' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['MV'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'NI' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['NI'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'NW' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['NW'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'RP' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['RP'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'SL' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['SL'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'SN' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['SN'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'ST' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['ST'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'SH' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['SH'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'TH' => array
        (
            'label'                   => &$GLOBALS['TL_LANG'][tl_lb_holiday_state]['TH'],
            'default'                 => 1,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        )
    )
    );