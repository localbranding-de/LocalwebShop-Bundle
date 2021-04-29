<?php

/**
 * Table tl_lb_member_shop_products
 */

$GLOBALS['TL_DCA']['tl_lb_member_00_shop_products'] = array
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
    // Palettes
    'palettes' => array
    (
        '__selector__'                => array('lb_memberid,lb_productid'),
        'default'                     => '{lb_member_product_legend},lb_memberid,lb_productid;'
        
    ),
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                 => "int(10) unsigned NOT NULL auto_increment",
        ),
        'lb_memberid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_member_shop_products']['lb_memberid'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'exclude'   => true,
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'foreignKey'         => 'tl_member.id',
            'relation'           => array('type'=>'belongsTo', 'load'=>'lazy'),
            'options_callback'  => array('tl_lb_member_shop_products_class', 'myMemberOptionsCallback'),
            'inputType'          => 'select'
        ),
        'lb_productid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_member_shop_products']['lb_productid'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'exclude'            => true,
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'foreignKey'         => 'tl_ls_shop_product.id',
            'relation'           => array('type'=>'belongsTo', 'load'=>'lazy'),
            'options_callback'   => array('tl_lb_member_shop_products_class', 'myProductOptionsCallback'),
            'inputType'          => 'select'
        ),
        'cid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_member_shop_products']['lb_cid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'cdate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_member_shop_products']['lb_cdate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'uid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_member_shop_products']['lb_uid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'udate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_member_shop_products']['lb_udate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'tstamp' => array
        (
            'sql'                => "int(10) unsigned NOT NULL default '0'"
        )
    ),
    
    
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 2,
            'fields'                  => array('lb_memberid','lb_productid'),
            'panelLayout'             => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('lb_memberid','lb_productid'),
            'showColumns'             => true,
            'label_callback'          => array('tl_lb_member_shop_products_class','myLabelCallback')
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_member_shop_products']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_member_shop_products']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.svg',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            )
        )
    )
);


class tl_lb_member_shop_products_class extends Backend
{
    /**
     * options_callback: Ermöglicht das Befüllen eines Drop-Down-Menüs oder einer Checkbox-Liste mittels einer individuellen Funktion.
     * @param  $dc
     * @return array
     */
    public function myProductOptionsCallback(DataContainer $dc)
    {
        $values = array();
        $products = $this->Database->prepare("SELECT id,title FROM tl_ls_shop_product WHERE lb_isConsulting = TRUE ")->execute();
        //Array erzeugen
        while($products->next())
        {
            $values[$products->id] = "<b>".$products->title."</b> ";
        }
        return $values;
    }
    public function myMemberOptionsCallback(DataContainer $dc)
    {
        $values = array();
        $members = $this->Database->prepare("SELECT id,firstname,lastname FROM tl_member WHERE lb_isStaff = TRUE ")->execute();
        //Array erzeugen
        while($members->next())
        {
            $values[$members->id] = $members->lastname." ".$members->firstname;
        }
        return $values;
    }
    
    public function myLabelCallback($row)
    {
        $rows=array();// Do something
        $memberid=$row['lb_memberid'];
        $productid=$row['lb_productid'];
        $member = $this->Database->prepare("SELECT firstname, lastname FROM tl_member WHERE id= '$memberid' ")->execute();
        $product = $this->Database->prepare("SELECT title FROM tl_ls_shop_product WHERE id= '$productid' ")->execute();
        while($member->next())
        {
            $rows['lb_memberid'] = "".$member->lastname." ".$member->firstname;
        }
        while($product->next())
        {
            $rows['lb_productid'] = $product->title;
        }
        return $rows;
    }
    
}