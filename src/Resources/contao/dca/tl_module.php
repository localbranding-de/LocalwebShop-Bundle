<?php
// dca/tl_module.php
$GLOBALS['TL_DCA']['tl_module']['fields']['cal_content'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['cal_content'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class' => 'clr'),
    'sql'                     => "mediumtext NULL"
);

// dca/tl_module.phpy

$GLOBALS['TL_DCA']['tl_module']['palettes']['lb_booking'] = '{type_legend},type,name;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['lb_booking'].= '{content_legend},cal_content;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['lb_booking'].= '{template_legend:hide},customTpl;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['lb_booking'].= '{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible,start,stop';