<?php
/**
 * Table tl_lb_logo
 */



$GLOBALS['TL_DCA']['tl_lb_logo'] = array
(
    
    // Config
    'config' => array
    (
        'closed'                      => true,
        //'onsubmit_callback'             => array(array('Branding_class', 'myOnsubmitCallback')),
        'dataContainer'               => 'File'
        

    ),
    // Palettes
    'palettes' => array
    (

        'default'                     => '{logo_legend},logo;'
        
    ),
    // Fields
    'fields' => array
    (

        'logo' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_logo']['logo'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'save_callback' => array(array('Logo_class','logoSaveCallback')),
            'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'tl_class'=>'clr', 'extensions'=>$GLOBALS['TL_CONFIG']['validImageTypes']),
            'sql'                     => "blob NULL"
        ),
        'cid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['lb_cid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'cdate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['lb_cdate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'uid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['lb_uid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'udate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['lb_udate'],
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
           
            'fields'                  => array('spotcolor1')
        ),
        'label' => array
        (
            'fields'                  => array('spotcolor1'),
            'showColumns'             => true
            
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_costType']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
            )
        )
    )
    

    
);

class Logo_class
{
    
    
    public function writeSaveCallback($varValue,$varName)
    {
        

        $themedir=scandir('../files/');
        foreach($themedir as $dirname)
        {
            
            if (strpos($dirname, 'theme_lb_') !== false) {
                
                $lb_theme=$dirname;
                break;
            }
        }
        
        $dir=scandir('../files/'.$lb_theme.'/css/');
        foreach($dir as $filename)
        {
            if (strpos($filename, 'branding') !== false) {
                
                $css_file_name=$filename;
                break;
            }
            
            
        }
        $path='../files/'.$lb_theme.'/css/'.$css_file_name;
        $contents=file_get_contents($path);
        $start=strpos($contents,$varName);
        $mid=strpos($contents,":",$start);
        $end=strpos($contents,";",$start);
        $length=$end-$start;
        $string=$varName .": #". $varValue;
       
        file_put_contents($path,substr_replace($contents,$string,$start,$length));
        
        return $varValue;
    }
    public function spotcolor1SaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'spotcolor1');
        return $varValue;
    }
    public function spotcolor2SaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'spotcolor2');
        return $varValue;
    }
    public function blackSaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'black');
        return $varValue;
    }
    public function midgreySaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'midgrey');
        return $varValue;
    }
    public function lightgreySaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'lightgrey');
        return $varValue;
    }
    public function whiteSaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'white');
        return $varValue;
    }
    public function bodybackgroundSaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'bodybackground');
        return $varValue;
    }
    public function errorSaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'error');
        return $varValue;
    }
    public function successSaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'success');
        return $varValue;
    }
    public function infoSaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'info');
        return $varValue;
    }
    public function signalSaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'signal');
        return $varValue;
    }
    public function warningSaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'warning');
        return $varValue;
    }
    public function inactiveSaveCallback($varValue, DataContainer $dc)
    {
        $this->writeSaveCallback($varValue,'inactive');
        return $varValue;
    }
    
    public function logoSaveCallback($varValue, DataContainer $dc)
    {
        
        $themedir=scandir('../templates/');
        foreach($themedir as $dirname)
        {
            
            if (strpos($dirname, 'theme_lb_') !== false) {
                
                $lb_theme=$dirname;
                break;
            }
        }
        
        $dir=scandir('../templates/'.$lb_theme);
        foreach($dir as $filename)
        {
            if (strpos($filename, 'rsce_lb_navbar') !== false) {
                
                $tpl_file_name=$filename;
                break;
            }
            
            
        }
        $path='../templates/'.$lb_theme.'/'.$tpl_file_name;
        $contents=file_get_contents($path);

        $start=strpos($contents,"<!-- Logostart -->")+18;
   
        
        $end=strpos($contents,"<!-- Logoend -->",$start)-2;
        $length=$end-$start;

        
       
        $insert = '{{picture::'.$varValue.'?template=pictureLogo_default&width=260&height=auto&alt={{page::rootTitle}} Logo}}';
        file_put_contents('path',$path);
        
        $tplContent=file_get_contents('../vendor/localbranding-de/branding-bundle/src/Resources/contao/templates/modules/pictureLogo_default.html5');
        file_put_contents('path2',$tplContent);
        file_put_contents('../templates/'.$lb_theme.'/pictureLogo_default.html5',$tplContent);
        file_put_contents($path,substr_replace($contents,$insert,$start,$length+2));
        return $varValue;
    }
    /**
     * onsubmit_callback: Wird beim Abschicken eines Backend-Formulars ausgeführt.
     * @param $dc
     */
    public function myOnsubmitCallback($dc){

   
    }
}