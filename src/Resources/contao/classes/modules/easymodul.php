<?php
namespace CalendarBooking\classes\modules;
/**
 * Class easymodul
 * @package CalendarBooking\classes\modules
 */
class easymodul extends \Module
{
    /**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_easymodul';
	/**
	 * Generate the frontend output
	 */
	protected function compile()
	{
	    
	    foreach (array_keys($_SESSION['lsShopCart']['items']) as $key)
	    {
	       $prodid=strstr($key,'-',TRUE);
	       $result = \Database::getinstance()->prepare('SELECT lb_isConsulting from tl_ls_shop_product WHERE id=?')->execute($prodid);
	    }
	    $outputarr= array();
	    $locations = \Database::getInstance()->prepare("select * from tl_lb_location ORDER BY locationName DESC")->execute();
	    if ($locations->numRows > 0) {
	        while ($locations->next()) {
	            $text=$locations->locationName.": ".$locations->street.", ".$locations->zipcode." ".$locations->city;
	            
	            $bhtml="<b calid=\"".$locations->calendar_id." \" text= \"".$text." \">".$locations->locationName." in ".$locations->city."</b>";
	            $html="<a data_id=\"".$locations->id." \"  class='dropdownitem' href= '#' >".$bhtml."</a>";
	            $outputarr[ $locations->locationName]= $html;
	        }
	        $this->Template->locations = $outputarr;
	    }
	    
	    if (isset($_POST['type'])) {
	        /**
	         * if $_POST['type']) is set then we have to handle ajax calls from fullcalendar
	         *
	         * We check if the given $type is an existing method
	         * - if yes then call the function
	         * - if no just do nothing right now (for the moment)
	         */
	        $type = $_POST['type'];
	        if (method_exists($this, $type)) {
	            $this->$type();
	        }
	    }
	    
	}
	
	protected function getMemberLocation($id,$weekstart,$weekend)
	{
	    $locations=array();
	  // file_put_contents('cache_cile',\Database::getInstance()->prepare("SELECT tl_member.lb_location FROM tl_member,tl_lb_exception WHERE tl_member.id=? AND NOT (tl_lb_exception.datestart BETWEEN ? and ? ) AND NOT (tl_lb_exception.dateend BETWEEN ? and ? )")->execute($id,$weekstart,$weekend,$weekstart,$weekend)->lb_location, FILE_APPEND);
	    array_push($locations,\Database::getInstance()->prepare("SELECT tl_member.lb_location FROM tl_member,tl_lb_exception WHERE tl_member.id=? AND NOT (tl_lb_exception.datestart BETWEEN ? and ? ) AND NOT (tl_lb_exception.dateend BETWEEN ? and ? )")->execute($id,$weekstart,$weekend,$weekstart,$weekend)->lb_location);
	   $exclocations=\Database::getInstance()->prepare("SELECT location FROM tl_lb_exception WHERE memberid=? AND ((datestart BETWEEN ? and ?) OR (dateend BETWEEN ? AND ?))")->execute($id,$weekstart,$weekend,$weekstart,$weekend);
	
	   while($exclocations->next())
	   {
	       if(!empty($exclocations))
	       {
	       array_push($locations,$exclocations->location);
	       }
	   }
	   
	   
	  
	    return array_unique($locations);
	    
	}
	
	protected function getProdLocation($id,$weekstart,$weekend)
	{
	    $locations=array();
	   $members=\Database::getInstance()->prepare("SELECT lb_memberid FROM tl_lb_member_00_shop_products WHERE lb_productid=?")->execute($id);
	   
	   while ($members->next())
	   {
	      
	       array_push($locations,$this->getMemberLocation($members->lb_memberid,$weekstart,$weekend));
	   }
	   return array_unique($locations);
	}
	
	  
	
	 protected function adjustDrop()
	 {
	     if(\Input::post('prod'))
	     {
	         $id=\Input::post('prod');
	         $weekstart=\Input::post('start');
	         $weekend =\Input::post('end');
	         $locations=$this->getProdLocation($id,$weekstart,$weekend);
	        
	         echo json_encode($locations);
	         exit;
	     }
	     else
	     {
	         echo "no";
	         exit;
	     }
	 }

}