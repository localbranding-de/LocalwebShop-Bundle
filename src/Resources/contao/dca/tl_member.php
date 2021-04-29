<?php
/**
 * Table tl_member
 */
    
    
//Legenden hinzuf�gen
$GLOBALS['TL_DCA']['tl_member']['palettes']['default']=str_replace('{contact_legend','{staff_legend},lb_IsStaff,;{contact_legend',$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] );
$GLOBALS['TL_DCA']['tl_member']['subpalettes']['lb_IsStaff'] ='lb_staffCalendar,lb_workstart,lb_workend,lb_location,lb_allocationException,lb_staffCompetences';
$GLOBALS['TL_DCA']['tl_member']['palettes']['__selector__'][] = 'lb_IsStaff';
// Hinzuf�gen der Feld-Konfiguration
$GLOBALS['TL_DCA']['tl_member']['fields']['lb_location'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['lb_location'],
    'exclude'   => true,
    'inputType' => 'select',
    'eval'      => array('feEditable'=>true, 'feViewable'=>true, 'tl_class'=>'w50'),
    'foreignKey'=> 'tl_lb_location.locationName',
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['lb_IsStaff'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['lb_IsStaff'],
    'exclude'                 => true,
    'eval'                    => array('submitOnChange'=>true),
    'filter'                  => true,
    'inputType'               => 'checkbox',
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['lb_staffCalendar'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['lb_staffCalendar'],
    'exclude'   => true,
    'inputType' => 'select',
    'eval'      => array('feGroup'=>'lb_IsStaff','submitOnChange'=>true,'feEditable'=>true, 'feViewable'=>true),
    'foreignKey'=> 'tl_calendar.id',
    'options_callback'  => array('lb_tl_member', 'myOptionsCallback'),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['lb_workstart'] = array
(
    'default'                 => time(),
    'label'              => &$GLOBALS['TL_LANG']['tl_member']['lb_workstart'],
    'sql'                => "varchar(64) COLLATE utf8_bin NULL",
    'eval'                    => array('rgxp'=>'time', 'mandatory'=>true, 'doNotCopy'=>true, 'tl_class'=>'w50'),
    'inputType'          => 'text'
);

$GLOBALS['TL_DCA']['tl_member']['fields']['lb_workend'] = array
(
    'default'                 => time(),
    'label'              => &$GLOBALS['TL_LANG']['tl_member']['lb_workend'],
    'sql'                => "varchar(64) COLLATE utf8_bin NULL",
    'eval'                    => array('rgxp'=>'time', 'mandatory'=>true, 'doNotCopy'=>true, 'tl_class'=>'w50'),
    'inputType'          => 'text'
);



$GLOBALS['TL_DCA']['tl_member']['fields']['lb_staffCompetences']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_member']['lb_staffCompetences'],
    'exclude' 		=> true,
    'inputType' 		=> 'multiColumnWizard',
    'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'columnFields' => array
        (
            'competences' => array
            (
                'label'                 => &$GLOBALS['TL_LANG']['tl_member']['lb_staffCompetencesSelect'],
                'exclude'               => true,
                'inputType'             => 'select',
                'save_callback'           => array(array('lb_tl_member','wzSaveCallback')),
                'options_callback'      => array('lb_tl_member','staffOptionsCallback'),
                'eval' 			=> array('style' => 'width:250px', 'chosen'=>true)
            ),
        ),
        'unique'=>true, 'tl_class'=>'w50'
    ),
    'sql'                     => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['lb_allocationException']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_member']['lb_allocationException'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
   // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'columnFields' => array
        (
            'exceptionDate' => array
            (
                'label'                 => &$GLOBALS['TL_LANG']['tl_member']['lb_exceptionSelectDate'],
                'exclude'               => true,
                'inputType'             => 'text',
                //'save_callback'           => array(array('lb_tl_member','wzSaveCallback')),
               // 'options_callback'      => array('lb_tl_member','staffOptionsCallback'),
                'eval'      => array('rgxp'=>'date', 'datepicker'=>true, 'feViewable'=>true, 'feGroup'=>'personal','tl_class'=>'w50 wizard')
            ),
            'location' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_member']['lb_exceptionSelectLocation'],
                'exclude'   => true,
                'inputType' => 'select',
                'eval'      => array('feEditable'=>true, 'feViewable'=>true),
                'foreignKey'=> 'tl_lb_location.locationName',
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
        ),
         'tl_class'=>'w50'
    ),
    'sql' => "blob NULL"
);

class lb_tl_member extends Backend
{
    /**
     * options_callback: Erm�glicht das Bef�llen eines Drop-Down-Men�s oder einer Checkbox-Liste mittels einer individuellen Funktion.
     * @param  $dc
     * @return array
     */
    public function myOptionsCallback(DataContainer $dc)
    {
        $values = array();
        $calendars = $this->Database->prepare("SELECT id,title FROM tl_calendar WHERE  lb_calendartype = 'Mitarbeiterkalender' ORDER BY title ASC")->execute();
        //Array erzeugen
        while($calendars->next())
        {
            $values[$calendars->id] = "<b>".$calendars->title."</b> ";
        }
        return $values;
    }
    
    public function myLabelCallback($row)
    {
        $rows=array();
        $id=$row['memberid'];
        $member = $this->Database->prepare("SELECT tl_member.firstname, tl_member.lastname, tl_lb_location.locationName FROM tl_member INNER JOIN tl_lb_location ON tl_member.lb_location= tl_lb_location.id WHERE tl_member.id='$id' ORDER BY lastname ASC")->execute();
        while($member->next())
        {
            $rows['membername'] = "<b>".$member->firstname."</b>".$member->lastname;
        }
        $rows['location']=$member->locationName;
        $rows['date'] = gmdate("Y-m-d", $row['date']);
        return $rows;
    }
    
    public function staffOptionsCallback()
    {
        $values = array();
        $products = $this->Database->prepare("SELECT id, title FROM tl_ls_shop_product WHERE lb_isConsulting=? ORDER BY title ASC ")->execute(1);
        while($products->next())
        {
            $values[$products->id] = "<b>".$products->title."</b> ";
        }
        return $values;
    }
    
    public function wzSaveCallback($varValue, MultiColumnWizard $dc)
    {
        
        return $varValue;
    }
    
    public function mySaveCallback($varValue, DataContainer $dc)
    {
        //$this->Database->prepare("INSERT INTO tl_lb_member_00_shop_products(lb_memberid, lb_productid) VALUES (?,?)")->execute($dc->id,$varValue);
        //$vals= $dc->getAttributesFromDca($dc);
        //foreach($vals as $val)
        //{
        //   file_put_contents("cache_file",$val."\n",FILE_APPEND);
        //}
        return $varValue;
    }
}