<?php

namespace mhg;

class ExitIntentStart extends \Contao\ContentElement {

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_exitintent_start';

    /**
     * Generate the content element
     */
    protected function compile() {
        if (TL_MODE == 'BE') {
            $this->strTemplate = 'be_wildcard';
            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate($this->strTemplate);
            $this->Template = $objTemplate;
            return $objTemplate;
        }
        
        $rs = \Database::getInstance()->prepare ("SELECT exitintent_steps, exitintent_delay, exitintent_top, exitintent_top_size, "
                . "exitintent_bottom, exitintent_bottom_size, exitintent_left, exitintent_left_size, exitintent_right, exitintent_right_size,"
                . "exitintent_square, exitintent_square_top,exitintent_cookie_activate, exitintent_cookie_timer "
                . "FROM tl_content WHERE id = ? ORDER BY sorting") 
                ->execute ($this->id);
        
        $exitintent_vars = $rs->fetchAllAssoc()[0];
        $this->Template->exitintent_vars = json_encode( (object) $exitintent_vars );
        $this->Template->showLightbox = 1;
        
        //cookiedata
        if ( $exitintent_vars['exitintent_cookie_activate'] == '1' ) {
            $cookie_days = $exitintent_vars['exitintent_cookie_timer'];
            $cookie_name = "ExitintentionCookie";
            $cookie_expires = time() + ( 86400 * $cookie_days );
            $cookie_domain = '';
            $cookie_secure = false;
            $cookie_httponly = false;
            
            if(!isset($_COOKIE[$cookie_name])) {
                setcookie($cookie_name, $cookie_expires, $cookie_expires, $cookie_path, $cookie_domain, $cookie_secure, $cookie_httponly);
                $this->Template->showLightbox = 1;
            } else {
                //current time larger than expiration date -> show lightbox and set cookie again
                if ( time() >= $_COOKIE[$cookie_name] ) {
                    $this->Template->showLightbox = 1;
                    setcookie($cookie_name, $cookie_expires, $cookie_expires, $cookie_path, $cookie_domain, $cookie_secure, $cookie_httponly);
                } else {
                    $this->Template->showLightbox = 0;
                }
            }
        }
    } 
}