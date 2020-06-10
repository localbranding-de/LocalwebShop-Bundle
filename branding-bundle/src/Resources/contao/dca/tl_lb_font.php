<?php
/**
 * Table tl_lb_font
 */



$GLOBALS['TL_DCA']['tl_lb_font'] = array
(
    
    // Config
    'config' => array
    (
        'closed'                      => true,
        //'onsubmit_callback'             => array(array('Branding_class', 'myOnsubmitCallback')),
        'dataContainer'               => 'File',
        'onload_callback' => array(array('BrandingFont_class', 'myOnloadCallback'))
        

    ),
    // Palettes
    'palettes' => array
    (

        'default'                     => '{primary_legend},font1,font2;'
        
    ),
    // Fields
    'fields' => array
    (


        'font1' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_font']['font1'],
            'inputType' => 'select',
            'save_callback' => array(array('BrandingFont_class','font1SaveCallback')),
            'options_callback' => array('BrandingFont_class','fontOptionsCallback'),
            'eval'      =>array( 'includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...','tl_class'=>'long '),
            'sql'       => "varchar(255) NOT NULL default ''" 
        ),
        'font2' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_font']['font2'],
            'inputType' => 'select',
            'save_callback' => array(array('BrandingFont_class','font2SaveCallback')),
            'options_callback' => array('BrandingFont_class','fontOptionsCallback'),
            'eval'      =>array('includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...', 'tl_class'=>'long '),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'resetToDefault' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_font']['resetToDefault'],
            'inputType' => 'checkbox',
            'exclude'               => true,
            'default'               => 0,
            'eval'                  => ['tl_class'=>'w50'],
            'save_callback' => array(array('BrandingFont_class','resetToDefaultSaveCallback')),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'cid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_font']['lb_cid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'cdate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_font']['lb_cdate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'uid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_font']['lb_uid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'udate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_font']['lb_udate'],
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
           
            'fields'                  => array('font1','font2')
        ),
        'label' => array
        (
            'fields'                  => array('font1','font2'),
            'showColumns'             => true
            
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_font']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
            )
        )
    )
    

    
);

class BrandingFont_class extends Backend
{
    
    public function myOnloadCallback($dc){
        $css_string ="";
        $themedir=scandir('../files/');
        foreach($themedir as $dirname)
        {
            
            if (strpos($dirname, 'theme_lb_') !== false) {
                
                $lb_theme=$dirname;
                break;
            }
        }
        
        $dir=scandir('../files/'.$lb_theme.'/fonts/');
        $fonts = $this->Database->prepare("SELECT id,font,font_group,license FROM tl_lb_fontAdmission ORDER BY font_group ASC")->execute($group);
        while($fonts->next())
        {
            
            $font_name=$fonts->font;
            $font_nameT =str_replace(" ", "", $font_name);
            
            
        
       
            foreach($dir as $filename)
            {
                if ($filename==$font_nameT) 
                {
                    $font_files=scandir('../files/'.$lb_theme.'/fonts/'.$filename);
                    foreach($font_files as $font_file)
                    {
                        $regularWoff;
                        $regularWoff2;
                        $boldWoff;
                        $boldWoff2;
                    
                                        
                        if ( strpos($font_file, '-regular.woff2') !== false)
                        {
                            
                            $regularWoff=$font_file;
                            
                        }
                        elseif ( strpos($font_file, '-regular.woff') !== false)
                        {
                            
                            $regularWoff2=$font_file;
                            
                        }
                        elseif ( strpos($font_file, '-700.woff2') !== false)
                        {
                            
                            $boldWoff=$font_file;
                           
                        }
                        elseif ( strpos($font_file, '-700.woff') !== false)
                        {
                            
                            $boldWoff2=$font_file;
                            
                        }
                        
                        
                           
                    }
                    
                    $fontCss = "@font-face {
  font-family: '".$font_name."';
  src: url('../../../files/theme_lb_demoshop/fonts/".$font_nameT."/".$regularWoff2."') format('woff2'),
  url('../../../files/theme_lb_demoshop/fonts/".$font_nameT."/".$regularWoff."') format('woff');
  font-weight: normal;
  font-style: normal;
}
@font-face {
  font-family: '".$font_name."';
  src: url('../../../files/theme_lb_demoshop/fonts/".$font_nameT."/".$boldWoff2."') format('woff2'),
  url('../../../files/theme_lb_demoshop/fonts/".$font_nameT."/".$boldWoff."') format('woff');
  font-weight: bold;
  font-style: normal;
}
      
.".$font_nameT." {
	font-family: ".$font_name.", sans-serif;
	    
}
.".$font_nameT." h1,h2 {
	font-weight:normal;
	font-size: 29px;
}
.".$font_nameT." h2{
	margin-bottom: .5rem;
}
    
";
                    if(!isset($boldWoff)&&!isset($boldWoff2))
                    {
                        
                        $fontCss = "@font-face {
  font-family: '".$font_name."';
  src: url('../../../files/theme_lb_demoshop/fonts/".$font_nameT."/".$regularWoff2."') format('woff2'),
  url('../../../files/theme_lb_demoshop/fonts/".$font_nameT."/".$regularWoff."') format('woff');
  font-weight: normal;
  font-style: normal;
}
  
.".$font_nameT." {
	font-family: ".$font_name.", sans-serif;
	    
}
.".$font_nameT." h1,h2 {
	font-weight:normal;
	font-size: 29px;
}
.".$font_nameT." h2{
	margin-bottom: .5rem;
}
";
                    }
                    unset($regularWoff,$regularWoff2,$boldWoff,$boldWoff2);

                    $css_string = $css_string.$fontCss;
                    break;
                }
                
                
            }
        

            
            file_put_contents('../vendor/localbranding-de/branding-bundle/src/Resources/public/css/lb_be_font.css',$css_string);
        }
       
        
        

    }

    public function fontOptionsCallback(DataContainer $dc)
    {
        $options=array();
        $groups= ['Sans Serif','Serif','Display','Monospace','Handwriting'];
        
        foreach($groups as $group)
        {
            $options[]="-- Gruppe ".$group." --";
            $fonts = $this->Database->prepare("SELECT id,font,font_group,license FROM tl_lb_fontAdmission WHERE font_group = ? ORDER BY font ASC")->execute($group);
            while($fonts->next())
            {
                $options[] = $fonts->font;
                
                
                
            }
        

        }
        


        return $options;
    }
    
    public function writeFontSaveCallback($varValue,$varName)
    {
       
        $Words =str_replace(" ", "", $varValue);
        
        
        
        //$Words = substr(preg_replace('/(?<!\ )[A-Z]/', ' $0', $varValue),1);
        $themedir=scandir('../files/');
        foreach($themedir as $dirname)
        {
            
            if (strpos($dirname, 'theme_lb_') !== false) {
                
                $lb_theme=$dirname;
                break;
            }
        }
        
        $dir=scandir('../files/'.$lb_theme.'/fonts/');
        foreach($dir as $filename)
        {
            if ($filename==$Words) {
                $font_files=scandir('../files/'.$lb_theme.'/fonts/'.$filename);
                foreach($font_files as $font_file)
                {
                    $regularWoff;
                    $regularWoff2;
                    $boldWoff;
                    $boldWoff2;
                    
                    
                    if ( strpos($font_file, '-regular.woff2') !== false) 
                    {                                                                               
                        
                        $regularWoff2=$font_file;
                        
                    }
                    elseif ( strpos($font_file, '-regular.woff') !== false)
                    {
                        
                        $regularWoff=$font_file;
                        
                    }
                    elseif ( strpos($font_file, '-700.woff2') !== false)
                    {
                        
                        $boldWoff2=$font_file;
                        
                    }
                    elseif ( strpos($font_file, '-700.woff') !== false)
                    {
                        
                        $boldWoff=$font_file;
                        
                    }
                    
                    
                }
               
                
                break;
            }
            
            
        }
  

        $fontCss = "@font-face {
  font-family: '".$varValue."';
  src: url('../../../files/theme_lb_demoshop/fonts/".$Words."/".$regularWoff2."') format('woff2'),
  url('../../../files/theme_lb_demoshop/fonts/".$Words."/".$regularWoff."') format('woff');
  font-weight: normal;
  font-style: normal;
}
@font-face {
  font-family: '".$varValue."';
  src: url('../../../files/theme_lb_demoshop/fonts/".$Words."/".$boldWoff2."') format('woff2'),
  url('../../../files/theme_lb_demoshop/fonts/".$Words."/".$boldWoff."') format('woff');
  font-weight: bold;
  font-style: normal;
}";
              
        if(!isset($boldWoff)&&!isset($boldWoff2))
        {
            
            $fontCss = "@font-face {
  font-family: '".$varValue."';
  src: url('../../../files/theme_lb_demoshop/fonts/".$Words."/".$regularWoff2."') format('woff2'),
  url('../../../files/theme_lb_demoshop/fonts/".$Words."/".$regularWoff."') format('woff');
  font-weight: normal;
  font-style: normal;
}";
        }
        unset($regularWoff,$regularWoff2,$boldWoff,$boldWoff2);


   
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
        if($varName=='--theme-font-1')
        {
            $start=strpos($contents,"/* ///// Fonts ///// */");
            
            $end=strpos($contents,"/* ///// Fontsend ///// */");
            $length=$end-$start;
            $contents=substr_replace($contents,"/* ///// Fonts ///// */\r\n".$fontCss,$start,$length);
        }
        else
        {
            $start=strpos($contents,"/* ///// Fontsend ///// */");
            
            $end=strpos($contents,"/* ///// Fontsend ///// */");
            $length=$end-$start;
            $contents=str_replace("/* ///// Fontsend ///// */",$fontCss."\r\n/* ///// Fontsend ///// */",$contents);
        }
       
        
        
        
        
        
        
        
        
        
        $start=strpos($contents,$varName);
        $mid=strpos($contents,":",$start);
        $end=strpos($contents,";",$start);
        $length=$end-$start;
        $string=$varName .": '".$varValue."', sans-serif";
        
        file_put_contents($path,substr_replace($contents,$string,$start,$length));
        
        return $varValue;
    }
    
    
    public function font1SaveCallback($varValue, DataContainer $dc)
    {
        $this->writeFontSaveCallback($varValue,'--theme-font-1');
        return $varValue;
    }
    
    
    public function font2SaveCallback($varValue, DataContainer $dc)
    {
        $this->writeFontSaveCallback($varValue,'--theme-font-2');
        return $varValue;
    }
    public function resetToDefaultSaveCallback($varValue, DataContainer $dc)
    {
        if($varValue == 1)
        {
            $this->resetToDefault();
        }
       
       return 0;
    }
    public function resetToDefault()
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
        $defaultContents=file_get_contents('../files/'.$lb_theme.'/css/lb-default.css');
        
        $text= file_get_contents('../system/config/localconfig.php');

        $tagOne = "\$GLOBALS['TL_CONFIG']['font1']";
        $tagTwo = "\$GLOBALS['TL_CONFIG']['font2']";
        $replacement = "\$GLOBALS['TL_CONFIG']['font1'] = 'Lato';
\$GLOBALS['TL_CONFIG']['font2'] = 'Fira Mono';";
        
       
        
        $startTagPos = strrpos($text, $tagOne);
        
        $endTagPos = strrpos($text, $tagTwo);
        $EndTagEnd = strrpos(substr($text,$endTagPos),";")+1;
        $EndTagLen = ($endTagPos + $EndTagEnd)-$startTagPos;
        $tagLength = $endTagPos - $startTagPos;
        
        $newText = substr_replace($text, $replacement,
            $startTagPos, $EndTagLen);
        echo $newText;
        
        

        file_put_contents('../system/config/localconfig.php',$newText);
        file_put_contents($path,$defaultContents);
    }
  
}