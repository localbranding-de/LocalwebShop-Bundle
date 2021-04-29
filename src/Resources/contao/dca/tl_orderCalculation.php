<?php

$GLOBALS['TL_DCA']['tl_lb_holiday_business'] = array
(
'list' => array
(
    'global_operations' => array
    (
        'calculate' => array
        (
            'label'               => &$GLOBALS['TL_LANG']['tl_orderCalculation']['calculate'],
            'href'                => 'key=calculate',
            'icon'                => 'system/modules/CalendarBooking/images/dl.gif', 
            'attributes'          => 'onclick="Backend.getScrollOffset();"'
        ),
        // schnipp  
        )
),
  
);