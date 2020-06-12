<?php 

namespace LocalbrandingDe\LocalwebShopBundle\EventListener;
use \Datetime;
class MerconisHookClass// Klassenname = Dateiname (ohne .php)
{
    public function __construct() {} // eventuell nicht nötig, probieren
    
    public function myOutputTemplate($strContent, $strTemplate) {
        
        $result=\Database::getinstance()->prepare("SELECT id,updated from tl_calendar_events WHERE bought=0 AND NOT updated=0")->execute();
        while($result->next())
        {
            
            $updated=intval($result->updated);
            $time= time();
            $diff = $time - $updated;
            if($diff>=600)
            {
                
                
                \Database::getinstance()->prepare("DELETE FROM tl_calendar_events WHERE id =?")->execute($result->id);
                
                foreach($_SESSION['cal'] as $key => $val)
                {
                    $storeEvent = unserialize($_SESSION['cal'][$key]);
                    $storeEvent=json_encode($storeEvent);
                    $storeEvent=json_decode($storeEvent);
                    if($storeEvent->id==$result->id)
                    {
                        unset($_SESSION['cal'][$key]);
                    }
                }
            }
        }
        return $strContent;
        
        
    } 
    public function myStoreCartItemInOrder($arr_item, $obj_product) {

        setlocale(LC_TIME, "de_DE");
        file_put_contents("order",print_r($arr_item['extendedInfo'],True));
        file_put_contents("order2",print_r($_SESSION['cal'],True));
        
        foreach($_SESSION['cal'] as $key => $val)
        {
            $storeEvent = unserialize($_SESSION['cal'][$key]);
            $storeEvent=json_encode($storeEvent);
            $storeEvent=json_decode($storeEvent);
            if($arr_item['extendedInfo']['_productTitle_customerLanguage']==$storeEvent->product)
            {
                $start= strToTime($storeEvent->start);
                $end= strToTime($storeEvent->end);
                \Database::getinstance()->prepare("UPDATE tl_calendar_events SET bought=1 WHERE id=?")->execute($storeEvent->id);
                //OVerviewMail
                $arr_item['extendedInfo']['_deliveryTimeMessageInCart_customerLanguage'] = "Der Termin ist am ".strftime('%a',$start).", ".strftime('%d.',$start)." ".strftime('%B',$start)." ".strftime('%Y',$start)." von ".strftime('%H:%M',$start)." bis ".strftime('%H:%M',$end);
                //BackendOverview
                $arr_item['extendedInfo']['_deliveryTimeMessageInCart'] ="Der Termin ist am ".strftime('%a',$start).", ".strftime('%d.',$start)." ".strftime('%B',$start)." ".strftime('%Y',$start)." von ".strftime('%H:%M',$start)." bis ".strftime('%H:%M',$end);
                unset($_SESSION['cal'][$key]);
                $_SESSION['orderIDs'][]=$storeEvent->id;
            }
        }
        
        
        
        return $arr_item;

}

public function myAfterCheckout($orderID, $order) {

    foreach($_SESSION['orderIDs'] as $id)
    {
        \Database::getinstance()->prepare("UPDATE tl_calendar_events SET `order`=? WHERE id=?")->execute(array($orderID,$id));
    }
    unset($_SESSION['orderIDs']);
    
}







}
