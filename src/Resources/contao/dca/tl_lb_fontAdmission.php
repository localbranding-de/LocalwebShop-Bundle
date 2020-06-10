<?php
/**
 * Table tl_lb_fontAdmission
 */



$GLOBALS['TL_DCA']['tl_lb_fontAdmission'] = array
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
                'font' => 'index'
            )
        )
    ),
    // Palettes
    'palettes' => array
    (
        'default'                     => '{primary_legend},font,font_group,styles,license;'
        
    ),
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                 => "int(10) unsigned NOT NULL auto_increment",
        ),
        'font' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_fontAdmission']['font'],
            'inputType' => 'text',
            'eval'      => array('tl_class'=>'w50','maxlength'=>255),
            'sql'       => "varchar(256) NOT NULL default ''"
        ),
        'font_group' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_fontAdmission']['font_group'],
            'inputType' => 'select',
            'options'   => array('Sans Serif','Serif','Display','Handwriting','Monospace'),
            'eval'      => array('includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...','tl_class'=>'w50','maxlength'=>255),
            'sql'       => "varchar(256) NOT NULL default ''"
        ),
        'styles' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_fontAdmission']['styles'],
            'inputType' => 'text',
            'eval'      => array('tl_class'=>'w50','maxlength'=>255),
            'sql'       => "varchar(2) NOT NULL default '1'"
        ),
        'license' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_fontAdmission']['license'],
            'inputType' => 'select',
            'options'   => array('SIL Open Font License, Version 1.1.','Apache License Version 2.0'),
            'eval'      => array('includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...','tl_class'=>'w50','maxlength'=>255),
            'sql'       => "varchar(256) NOT NULL default ''"
        ),
        'cid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_fontAdmission']['lb_cid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'cdate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_fontAdmission']['lb_cdate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'uid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_fontAdmission']['lb_uid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'udate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_fontAdmission']['lb_udate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        )
    ),
    
    
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 2,
            'fields'                  => array('font','license','font_group'),
            'panelLayout'             => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('font','license','font_group'),
            'showColumns'             => true
            
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_fontAdmission']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_fontAdmission']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.svg',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            )
        )
    )
    
);
