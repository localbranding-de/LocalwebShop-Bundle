<?php

/**
 * Table tl_ls_shop_product
 */

$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default'] = str_replace('{lsShopPublishAndState_legend},','{lsShopConsulting},lb_isConsulting;{lsShopPublishAndState_legend},',$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default']);
//$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default'] = str_replace('published,lsShopProductIsNew,','published,lsShopProductIsNew,lb_isConsulting,',$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default']);

//$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default'] = str_replace('lsShopProductMengenvergleichUnit;','lsShopProductMengenvergleichUnit,lb_Duration;',$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default']);
$GLOBALS['TL_DCA']['tl_ls_shop_product']['subpalettes']['lb_isConsulting'] ='lb_Duration';
$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['__selector__'][] = 'lb_isConsulting';

// Hinzuf�gen der Feld-Konfiguration
$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_isConsulting'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_isConsulting'],
    'inputType' => 'checkbox',
    'eval'      => array( 'submitOnChange'=>true,'feEditable'=>true, 'feViewable'=>true,'tl_class'=>'w50'),
    'sql'       => "char(1) NOT NULL default ''"
);
/*$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_isConsultings'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_isConsultings'],
    'inputType' => 'checkbox',
    'eval'      => array( 'submitOnChange'=>true,'feEditable'=>true, 'feViewable'=>true,'tl_class'=>'w50'),
    'sql'       => "char(1) NOT NULL default ''"
);*/
$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_Duration'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_Duration'],
    'inputType' => 'select',
    'eval'      => array('feGroup'=>'lb_isConsulting','includeBlankOption' => true,'mandatory' => true ,'blankOptionLabel' => 'Bitte wählen ...','feEditable'=>true, 'feViewable'=>true,'tl_class'=>'w50'),
    'options_callback'  => array('lb_productClass', 'myOptionsCallback'),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);

class lb_productClass extends Backend
{
    /**
     * options_callback: Erm�glicht das Bef�llen eines Drop-Down-Men�s oder einer Checkbox-Liste mittels einer individuellen Funktion.
     * @param  $dc
     * @return array
     */
    public function myOptionsCallback(DataContainer $dc)
    {
        $values = array();
        $basetime = 15;
       
        for($i =1; ($i*$basetime)<=180;$i++)
        {
            $time= $i*$basetime;
            $values[$i] = "<b>".$time." Minuten</b> ";
        }
        return $values;
    }
    
    public function myLabelCallback($row)
    {
        $rows=array();// Do something
        $id=$row['memberid'];
        $member = $this->Database->prepare("SELECT tl_member.firstname, tl_member.lastname, tl_lb_location.name FROM tl_member INNER JOIN tl_lb_location ON tl_member.lb_location= tl_lb_location.id WHERE tl_member.id='$id' ORDER BY lastname ASC")->execute();
        while($member->next())
        {
            $rows['membername'] = "<b>".$member->firstname."</b> ".$member->lastname;
        }
        $rows['location']=$member->name;
        $rows['date'] = gmdate("Y-m-d", $row['date']);
        return $rows;
    }
    
}