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

<?php

/**
 * notification_center extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2008-2015, terminal42
 * @author     terminal42 gmbh <info@terminal42.ch>
 * @license    LGPL
 */

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD'], 1, array
    (
        'calendar_booking' => array
        (
            'lblocation' => array
            (
                'tables'        => array('tl_lb_location')
            ),
            /**  'lb_exceptions' => array
            (
                'tables' => array('tl_lb_exception')    
            ), */
            'buisness_holiday_date'=> array
            (
                'tables' => array('tl_lb_holiday_business')    
            )
            /**,
              'tl_lb_member_shop_products'=> array
            (
                'tables' => array('tl_lb_member_00_shop_products')
            )*/
        )
    ));


/**
 * Front end modules
 */

// Registrieren im Hooks replaceInsertTags
//$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('\CalenderBooking\classes\modules\LbInserttagClass', 'myReplaceInsertTags');

$GLOBALS['TL_LANG']['STATES']['BW']    = 'Baden Württemberg';
$GLOBALS['TL_LANG']['STATES']['BY']    = 'Bayern';
$GLOBALS['TL_LANG']['STATES']['BE']   = 'Berlin';
$GLOBALS['TL_LANG']['STATES']['BB'] = 'Brandenburg';
$GLOBALS['TL_LANG']['STATES']['HB']  = 'Bremen';
$GLOBALS['TL_LANG']['STATES']['HH']    = 'Hamburg';
$GLOBALS['TL_LANG']['STATES']['HE']  = 'Hessen';
$GLOBALS['TL_LANG']['STATES']['MV']  = 'Mecklenburg-Vorpommern';
$GLOBALS['TL_LANG']['STATES']['NI']  = 'Niedersachsen';
$GLOBALS['TL_LANG']['STATES']['NW']  = 'Nordrhein-Westfalen';
$GLOBALS['TL_LANG']['STATES']['RP']  = 'Rheinland-Pfalz';
$GLOBALS['TL_LANG']['STATES']['SL']  = 'Saarland';
$GLOBALS['TL_LANG']['STATES']['SN']  = 'Sachsen';
$GLOBALS['TL_LANG']['STATES']['ST']  = 'Sachsen-Anhalt';
$GLOBALS['TL_LANG']['STATES']['SH']  = 'Schleswig-Holstein';
$GLOBALS['TL_LANG']['STATES']['TH']  = 'Thüringen';

$GLOBALS['FE_MOD']['calendarbooking'] = array('lb_booking'=>'\CalendarBooking\classes\modules\easymodul');
$GLOBALS['TL_FFL']['lb_calendarfield']     = LbCalendarFormField::class;
$GLOBALS['FE_MOD']['miscellaneous']['locationselect'] = '\CalendarBooking\classes\modules\easymodul';


