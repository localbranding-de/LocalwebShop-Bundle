<?php
namespace CalendarBooking\classes;
class TestElement extends \ContentElement
{
    protected $strTemplate = 'ce_testelement';
    protected function compile()
    {
        if (TL_MODE == 'BE') {
            $this->strTemplate          = 'be_wildcard';
            $this->Template             = new \BackendTemplate($this->strTemplate);
            $this->Template->wildcard   = "### TestElement ###";
        } else {
            $this->Template->content = 'Dies ist die Testausgabe!';
        }
    }
}