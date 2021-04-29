<?php

/**
 * Table tl_lb_exception
 */

$GLOBALS['TL_DCA']['tl_lb_exception'] = array
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
                'memberid' => 'index',
                'location' => 'index'
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
        'memberid' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_exception']['member'],
            'exclude'   => true,
            'inputType' => 'select',
            'eval'      => array('feEditable'=>true, 'feViewable'=>true),
            'foreignKey'=> 'tl_member.firstname','tl_member.lastname',
            'relation'   => array('type'=>'belongsTo', 'load'=>'lazy'),
            'options_callback'  => array('myClass', 'myOptionsCallback'),
            'sql'       => "int(10) unsigned NOT NULL default '0'",
        ),
        'datestart' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_exception']['date'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('rgxp'=>'date', 'datepicker'=>true, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'personal', 'tl_class'=>'w50 wizard'),
            'sql'       => "varchar(11) NOT NULL default ''"
        ),
        'dateend' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_exception']['date'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('rgxp'=>'date', 'datepicker'=>true, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'personal', 'tl_class'=>'w50 wizard'),
            'sql'       => "varchar(11) NOT NULL default ''"
        ),
        'location' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_exception']['location'],
            'exclude'   => true,
            'inputType' => 'select',
            'eval'      => array('feEditable'=>true, 'feViewable'=>true),
            'foreignKey'=> 'tl_lb_location.locationName',
            'sql'       => "varchar(64) COLLATE utf8_bin NULL"  
        ),
        'cid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_exception']['lb_cid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'cdate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_exception']['lb_cdate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'uid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_exception']['lb_uid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'udate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_exception']['lb_udate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        )
    ),
    // Palettes
    'palettes' => array
    (
        '__selector__'                => array('firstname', 'lastname','location','datestart','dateend'),
        'default'                     => '{exception_legend},memberid,location,datestart,dateend;'
        
    ),
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 2,
            'fields'                  => array('memberid','datestart'),
            'panelLayout'             => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('memberid','location','datestart'),
            'showColumns'             => true,
            'label_callback'          => array('myClass','myLabelCallback')
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_location']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_member']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.svg'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_location']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.svg',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            )
        )
      )
);

class myClass extends Backend
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
        print_r($values);
        return $values;
    }
    
    public function myLabelCallback($row)
    {
        $rows=array();// Do something
        $id=$row['memberid'];
        $member = $this->Database->prepare("SELECT tl_member.firstname, tl_member.lastname, tl_lb_location.locationName FROM tl_member INNER JOIN tl_lb_location ON tl_member.lb_location= tl_lb_location.id WHERE tl_member.id='$id' ORDER BY lastname ASC")->execute();
        while($member->next())
        {
            $rows['membername'] = "".$member->lastname." ".$member->firstname;
        }
        $rows['location'] = $member->locationName;
        $rows['date'] = "".gmdate("Y-m-d", $row['datestart'])." bis ".gmdate("Y-m-d", $row['dateend']);
        return $rows;
    } 
    
}