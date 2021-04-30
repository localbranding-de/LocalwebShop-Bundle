<?php


class LbInsertagClass extends \Frontend
{
    public function myReplaceInsertTags($strTag)
    {
        // Parameter abtrennen
        $arrSplit = explode('::', $strTag);
        
        if ($arrSplit[0] != 'lb_user' && $arrSplit[0] != 'cache_lb_user')
        {
            //nicht unser Insert-Tag
            return false;
        }
        
        // Parameter angegeben?
        if (isset($arrSplit[1]) && $arrSplit[1] == 'cal_id')
        {
            if (TL_MODE == 'FE')
            {
                $this->import('FrontendUser', 'Member');
                if (FE_USER_LOGGED_IN)
                {
                    $Id = $this->Member->lb_staffCalendar;
                }
                else
                {
                    $Id = 0;
                }
            }
            return $Id;
        }
        else
        {
            return 'Fehler! foo ohne Parameter!';
        }
    }
}
