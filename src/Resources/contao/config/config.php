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



