<?php

/**
 * Table tl_lb_location
 */

$GLOBALS['TL_DCA']['tl_lb_location'] = array
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
                'locationName' => 'index'
            )
        )
    ),
    // Palettes
    'palettes' => array
    (
        '__selector__'                => array('locationName,city,street,zipcode,preRunTime'),
        'default'                     => '{location_legend},locationName,street,zipcode,city,state,geolocation;{calendar_legend},calendar_id;{time_legend},openTimeStart,openTimeEnd,lb_locationCalendar,preRunTime;'
        
    ),
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                 => "int(10) unsigned NOT NULL auto_increment",
        ),
        'locationName' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['locationName'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'city' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['city'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'street' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['street'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'preRunTime' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['preRunTime'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true, 'tl_class'=>'w50'),
            'inputType'          => 'select',
            'options_callback'  => array('lb_tl_location', 'preRunTimeOptionsCallback'),
        ),
        'zipcode' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['zipcode'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'calendar_id' => array 
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_location']['calendar_id'],
            'exclude'   => true,
            'inputType' => 'select',
            'eval'      => array('feEditable'=>true, 'feViewable'=>true),
            'foreignKey'=> 'tl_calendar.id',
            'options_callback'  => array('lb_tl_location', 'myOptionsCallback'),
            'sql'       => "int(10) unsigned NOT NULL default '0'"
        ),
        'state' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['state'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'options'            => array('BW','BY','BE','BB','HB','HH','HE','MV','NI','NW','RP','SL','SN','ST','SH','TH'),
            'reference' => &$GLOBALS['TL_LANG']['STATES'],
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'select'
        ),
        'openTimeStart' => array
        (
            'default'                 => time(),
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['openTimeStart'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'                    => array('rgxp'=>'time', 'mandatory'=>true, 'doNotCopy'=>true, 'tl_class'=>'w50'),
            'inputType'          => 'text'
        ),
        'openTimeEnd' => array
        (
            'default'                 => time(),
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['openTimeEnd'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'                    => array('rgxp'=>'time', 'mandatory'=>true, 'doNotCopy'=>true, 'tl_class'=>'w50'),
            'inputType'          => 'text'
        ),
        'geolocation' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['geo'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
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
            'mode'                    => 2,
            'fields'                  => array('locationName','street','zipcode','city','openTimeStart','openTimeEnd','preRunTime'),
            'panelLayout'             => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('locationName','street','zipcode','city','openTimeStart','openTimeEnd','preRunTime'),
            'showColumns'             => true,
            'label_callback'          => array('lb_tl_location','label_callback')
            
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_location']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
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
class lb_tl_location extends Backend
{
    /**
     * options_callback: Erm�glicht das Bef�llen eines Drop-Down-Men�s oder einer Checkbox-Liste mittels einer individuellen Funktion.
     * @param  $dc
     * @return array
     */
    private function secsToTime($seconds) {
        $t = round($seconds);
        $t += 3600;
        return sprintf('%02d:%02d', ($t/3600),($t/60%60));
    }
    
    public function myOptionsCallback(DataContainer $dc)
    {
        $values = array();
        $calendars = $this->Database->prepare("SELECT id,title FROM tl_calendar WHERE lb_calendartype = 'Standortskalender' ORDER BY title ASC")->execute();
        //Array erzeugen
        while($calendars->next())
        {
            $values[$calendars->id] = "<b>".$calendars->title."</b> ";
        }
        return $values;
    }
    
   public function label_callback($row)
   {
       $rows=array();
       $rows['locationName'] = $row['locationName'];
       $rows['street'] = $row['street'];
       $rows['zipcode'] = $row['zipcode'];
       $rows['city'] = $row['city'];   
       $rows['openTimeStart'] = $this->secsToTime($row['openTimeStart']); 
       $rows['openTimeEnd'] = $this->secsToTime($row['openTimeEnd']);
       if($row['preRunTime']>=5040)
       {
           if($row['preRunTime']==5040)
           {
               $rows['preRunTime'] = "1 Monat";
           }
           else
           {
               $rows['preRunTime'] = strval($row['preRunTime']/5040)." Monate";
           }
       }
       else if($row['preRunTime']>=160)
       {
           if($row['preRunTime']==160)
           {
               $rows['preRunTime'] = "1 Woche";
           }
           else
           {
               $rows['preRunTime'] = strval($row['preRunTime']/160)." Wochen";
           }
       }
       else if($row['preRunTime']>=24)
       {
           if($row['preRunTime']==24)
           {
               $rows['preRunTime'] = "1 Tag";
           }
           else
           {
               $rows['preRunTime'] = strval($row['preRunTime']/24)." Tage";
           }
       }
       else if($row['preRunTime']>=1)
       {
           if($row['preRunTime']==1)
           {
               $rows['preRunTime'] = "1 Stunde";
           }
           else
           {
               $rows['preRunTime'] = $row['preRunTime']." Stunden";
           }
           
       }
       else
       {
           $rows['preRunTime']="keine Vorlaufzeit";
       }
       return $rows;
   }
    
    public function preRunTimeOptionsCallback(DataContainer $dc)
    {
        $values = array();
        $basetime = 1;
        for($i =1; ($i*$basetime)<=12;$i++)
        {
            $time= $i*$basetime;
            if($i==1)
            {
                $values[$i] = "<b>".$time." Stunde</b> ";
            }
            else
            {
                $values[$i] = "<b>".$time." Stunden</b> ";
            }
            
        }
        $basetime = 24;
        for($i =1; ($i*$basetime)<=6*$basetime;$i++)
        {
            $time= $i*$basetime;
            if($i==1)
            {
                $values[$time] = "<b>".$i." Tag</b> ";
            }
            else
            {
                $values[$time] = "<b>".$i." Tage</b> ";
            }
        }
        $basetime = 168;
        for($i =1; ($i*$basetime)<=3*$basetime;$i++)
        {
            $time= $i*$basetime;
            if($i==1)
            {
                $values[$time] = "<b>".$i." Woche</b> ";
            }
            else
            {
                $values[$time] = "<b>".$i." Wochen</b> ";
            }
        }
        $basetime = 5040;
        for($i =1; ($i*$basetime)<=3*$basetime;$i++)
        {
            $time= $i*$basetime;
            if($i==1)
            {
                $values[$time] = "<b>".$i." Monat</b> ";
            }
            else
            {
                $values[$time] = "<b>".$i." Monate</b> ";
            }
        }
        return $values;
        
        
    }
        

    
}