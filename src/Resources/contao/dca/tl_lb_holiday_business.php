<?php

/**
 * Table tl_buidsness_holiday_date
 */

$GLOBALS['TL_DCA']['tl_lb_holiday_business'] = array
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
            'sql'       => "int(10) unsigned NOT NULL auto_increment",
        ),
        'date' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_holiday_business']['date'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('rgxp'=>'date', 'datepicker'=>true, 'feViewable'=>true, 'feGroup'=>'personal'),
            'sql'       => "varchar(11) NOT NULL default ''"
        ),
        'lb_location' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_holiday_business']['lb_location'],
            'exclude'   => true,
            'inputType' => 'select',
            'eval'      => array('feEditable'=>true, 'feViewable'=>true),
            'foreignKey'=> 'tl_lb_location.locationName',
            'sql'       => "int(10) unsigned NOT NULL default '0'"
        ),
        'holiday' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_holiday_business']['holiday'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('feViewable'=>true),
            'sql'       => "varchar(64) COLLATE utf8_bin NULL"
        ),
        'cid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_holiday_business']['lb_cid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'cdate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_holiday_business']['lb_cdate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'uid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_holiday_business']['lb_uid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'udate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_holiday_business']['lb_udate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'tstamp' => array
        (
            'sql'       => "int(10) unsigned NOT NULL default '0'"
        )
    ),
    // Palettes
    'palettes' => array
    (
        '__selector__'                => array('lb_location,date,holiday'),
        'default'                     => '{extra_holiday_legend},lb_location,date,holiday;'
        
    ),
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 2,
            'fields'                  => array('lb_location','date','holiday'),
            'panelLayout'             => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('lb_location','date','holiday'),
            'showColumns'             => true,
            'label_callback'          =>array('tl_lb_holiday_business_class','myLabelCallback'),
            
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_holiday_business']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_holiday_business']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.svg',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            )
        )
    )
);

class tl_lb_holiday_business_class extends Backend
{
    /**
     * options_callback: Ermöglicht das Befüllen eines Drop-Down-Menüs oder einer Checkbox-Liste mittels einer individuellen Funktion.
     * @param  $dc
     * @return array
     */
    public function myOptionsCallback(DataContainer $dc)
    {
        $values = array();
        $members = $this->Database->prepare("SELECT id,firstname,lastname FROM tl_member ORDER BY lastname ASC")->execute();
        //Array erzeugen
        while($members->next())
        {
            $values[$members->id] = "".$members->lastname." ".$members->firstname;
        }
        return $values;
    }
    
    public function mysOptionsCallback(DataContainer $dc)
    {
        $values = array();
        
        for($i =1; $i<=12;$i++)
        {
            $time= $i*15;
            $values[$i] = "<b>".$time." Minuten</b> ";
        }
        return $values;
    }
    
    public function myLabelCallback($row)
    {
        $rows=array();// Do something
        $rows['lb_location'] = $this->Database->prepare("SELECT locationName FROM tl_lb_location WHERE id=? ")->execute($row['lb_location'])->locationName;
		$rows['date'] = gmdate("Y-m-d", $row['date']);
        $rows['holiday'] = $row['holiday'];
        
        return $rows;
    }
    
}