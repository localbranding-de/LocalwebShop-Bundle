<?php

/**
 * Hooks.


$GLOBALS['TL_HOOKS']['outputBackendTemplate'][] = array(\LocalbrandingDe\LocalwebShopBundle\EventListener\OutputBackendTemplateListener::class, 'myOutputBackendTemplate');
$GLOBALS['TL_HOOKS']['parseTemplate'][] = array(\LocalbrandingDe\LocalwebShopBundle\EventListener\FrontendTemplateListener::class, 'myParseFrontendTemplate');
//$GLOBALS['TL_HOOKS']['parseBackendTemplate'][] = array(\LocalbrandingDe\LocalwebShopBundle\EventListener\ParseBackendTemplateListener::class, 'addScripts');
$GLOBALS['TL_HOOKS']['activateAccount'][] = array(\LocalbrandingDe\LocalwebShopBundle\EventListener\activateAccountListener::class, 'myActivateAccount');
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array(\LocalbrandingDe\LocalwebShopBundle\EventListener\FrontendTemplateListener::class, 'myOutputFrontendTemplate');
// Frontend modules
$GLOBALS['FE_MOD']['miscellaneous']['helloWorld'] = 'LocalbrandingDe\LocalwebShopBundle\HelloWorldModule';
//$GLOBALS['MERCONIS_HOOKS']['beforeAddToCart'][] = array(\LocalbrandingDe\LocalwebShopBundle\EventListener\MerconisHookClass::class, 'myBeforeAddToCart');
//$GLOBALS['TL_HOOKS']['createNewUser'][] = array(\LocalbrandingDe\LocalwebShopBundle\EventListener\createNewUserListener::class, 'myCreateNewUser');
if (TL_MODE == 'BE') {

}
 */
//$GLOBALS['FE_MOD']['LocalBranding Module']['bundleButton'] = 'LocalbrandingDe\LocalwebShopBundle\Module\BundleButtonModule';
//$GLOBALS['FE_MOD']['LocalBranding Module']['bundleHandler'] = 'LocalbrandingDe\LocalwebShopBundle\Module\BundleHandlerModule';
$GLOBALS['TL_HOOKS']['outputBackendTemplate'][] = array(\LocalbrandingDe\LocalwebShopBundle\EventListener\MerconisHookClass::class, 'myOutputTemplate');
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array(\LocalbrandingDe\LocalwebShopBundle\EventListener\MerconisHookClass::class, 'myOutputTemplate');
$GLOBALS['MERCONIS_HOOKS']['afterCheckout'][] = array(\LocalbrandingDe\LocalwebShopBundle\EventListener\MerconisHookClass::class, 'myAfterCheckout');
$GLOBALS['MERCONIS_HOOKS']['storeCartItemInOrder'][] = array(\LocalbrandingDe\LocalwebShopBundle\EventListener\MerconisHookClass::class, 'myStoreCartItemInOrder');
if ('BE' === TL_MODE) {

        $GLOBALS['TL_CSS'][] = '/bundles/branding/css/backend_svg.css';
    
}


if(\Input::get('do') == 'ls_shop_product'&&\Input::get('id'))
{


    //$GLOBALS['TL_JAVASCRIPT'][] = '/assets/jquery/js/jquery.min.js';
   // $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/branding/js/lb_be_products.js';
   // $GLOBALS['TL_CSS'][] = '/bundles/branding/css/lb_be_products.css';
}

if(\Input::get('do') == 'lb_branding_colors')
{


    $GLOBALS['TL_JAVASCRIPT'][] = '/assets/jquery/js/jquery.min.js';
    $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/branding/js/lb_de_branding.js';
    $GLOBALS['TL_CSS'][] = '/bundles/branding/css/lb_be_branding.css';
    $GLOBALS['TL_CSS'][] = '/files/theme_lb_demoshop/css/lb-default.css';

}

if(\Input::get('do') == 'lb_branding_font')
{
    
    
    $GLOBALS['TL_JAVASCRIPT'][] = '/assets/jquery/js/jquery.min.js';
    $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/branding/js/lb_be_font.js';
    $GLOBALS['TL_CSS'][] = '/bundles/branding/css/lb_be_font.css';
    $GLOBALS['TL_CSS'][] = '/files/theme_lb_demoshop/css/lb-default.css';
    
}


array_insert($GLOBALS['BE_MOD'], 0, array
    (
        'lb_branding' => array
        (
            'lb_branding_colors' => array
            (
                'tables'        => array('tl_lb_branding')
               
            ),
            'lb_branding_logo' => array
            (
                'tables'        => array('tl_lb_logo')
                
            ),
            'lb_branding_font' => array
            (
                'tables'        => array('tl_lb_font')
                
            ),
            'lb_fontAdmission' => array
            (
               'tables'        => array('tl_lb_fontAdmission')
            )
         )
    ));

