<?php 

class   myMerconisHookClass {
    
    
    
    
    
    
    
public function myInitializeCartController($cart, $itemsExtended, $calculation) {
    
    /*
    
    * Example: Adding products to the cart depending on the products that are currently in the cart.
    
    * In this example we assume that we have different brochures that we want to hand out if someone
    
    * orders a related product.
    
    *
    
    * We use the product's flexContent to store the relation between a product and a brochure
    
    * (flexContent key "associatedBrochures").
    
    *
    
    * Please note that this example is oversimplified in order to make the basic idea behind this hook
    
    * better understandable. This function is not intended to be used as it is in a real life scenario.
    
    * You will most likely have to complete this function and add some control mechanisms, trim the
    
    * comma separated list etc.
    
    */
    
    $this->import('Database');
    
    /*
    
    * If we want to do some cart manipulation we need to import the ls_shop_cartController class
    
    */
    
    $this->import('ls_shop_cartController');
    
    $arrBrochures = array();
    
    $arrBrochureIDs = array();
    
    /*
    
    * Walking through the cart item, using the extended array because we want to access
    
    * extended product information for which we need the product object
    
    */
    file_put_content("myFILE","TEST");
    foreach ($itemsExtended as $item) {
        
        /*
        
        * If the product has a corresponding flexContent, we assume it's a comma separated list holding
        
        * the brochure's product codes.
        
        */
        
        if ($item['objProduct']->_flexContentExists('associatedBrochures')) {
            
            $arrBrochures = array_merge($arrBrochures, explode(',', $item['objProduct']->_flexContents['associatedBrochures']));
            
        }
        
    }
    
    $arrBrochures = array_unique($arrBrochures);
    
    /*
    
    * Get the product ids of the brochures
    
    */
    
    foreach ($arrBrochures as $brochureArtNr) {
        
        $objBrochureProduct = $this->Database->prepare("
            
SELECT                    `id`
            
FROM                    `tl_ls_shop_product`
            
WHERE                    `lsShopProductCode` = ?
            
AND                    `published` = ?
            
")

->execute($brochureArtNr, '1');

if ($objBrochureProduct->numRows) {
    
    $objBrochureProduct->first();
    
    $arrBrochureIDs[] = $objBrochureProduct->id;
    
}

    }
    
    /*
    
    * We store the product ids of already added brochures in the session
    
    * because we don't want to add a brochure more than once.
    
    */
    
    if (!isset($_SESSION['myMerconis']['brochureIDsAddedToCart'])) {
        
        $_SESSION['myMerconis']['brochureIDsAddedToCart'] = array();
        
    }
    
    foreach ($arrBrochureIDs as $brochureID) {
        
        if (in_array($brochureID, $_SESSION['myMerconis']['brochureIDsAddedToCart'])) {
            
            continue;
            
        }
        
        $this->ls_shop_cartController->addToCart($brochureID, 1);
        
        $_SESSION['myMerconis']['brochureIDsAddedToCart'][] = $brochureID;
        
    }
    
}

}


?>