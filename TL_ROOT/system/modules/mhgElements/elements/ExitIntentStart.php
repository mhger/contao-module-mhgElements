<?php
/**
 * Contao 3 Extension [mhgElements]
 *
 * Copyright (c) 2017 Medienhaus Gersöne UG (haftungsbeschränkt) | Pierre Gersöne
 *
 * @package     mhgElements
 * @author      Pierre Gersöne <mail@medienhaus-gersoene.de>
 * @link        https://www.medienhaus-gersoene.de Medienhaus Gersöne - Agentur für Neue Medien: Web, Design & Marketing
 * @license     LGPL-3.0+
 */

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
        $GLOBALS['TL_CSS'][] = 'system/modules/mhgElements/assets/css/exitintent.css?v='.time();#||static';
        $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mhgElements/assets/js/jquery.exitintent.js';#|static';


        if (TL_MODE == 'BE') {
            $this->strTemplate = 'be_wildcard';
            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate($this->strTemplate);
            $this->Template = $objTemplate;
            return $objTemplate;
        }

        $rs = \Database::getInstance()->prepare("SELECT exitintent_steps, exitintent_delay, exitintent_top, exitintent_top_size, "
                        . "exitintent_bottom, exitintent_bottom_size, exitintent_left, exitintent_left_size, exitintent_right, exitintent_right_size,"
                        . "exitintent_square, exitintent_square_top,exitintent_cookie_activate, exitintent_cookie_timer "
                        . "FROM tl_content WHERE id = ? ORDER BY sorting")
                ->execute($this->id);

        $exitintent_vars = $rs->fetchAllAssoc()[0];
        $this->Template->exitintent_vars = json_encode((object) $exitintent_vars);
        $this->Template->showLightbox = 1;

        //cookiedata
        if ($exitintent_vars['exitintent_cookie_activate'] == '1') {
            $cookie_days = $exitintent_vars['exitintent_cookie_timer'];
            $cookie_name = "ExitintentionCookie";
            $cookie_expires = time() + ( 86400 * $cookie_days );
            $cookie_domain = '';
            $cookie_secure = false;
            $cookie_httponly = false;

            if (!isset($_COOKIE[$cookie_name])) {
                setcookie($cookie_name, $cookie_expires, $cookie_expires, $cookie_path, $cookie_domain, $cookie_secure, $cookie_httponly);
                $this->Template->showLightbox = 1;
            } else {
                //current time larger than expiration date -> show lightbox and set cookie again
                if (time() >= $_COOKIE[$cookie_name]) {
                    $this->Template->showLightbox = 1;
                    setcookie($cookie_name, $cookie_expires, $cookie_expires, $cookie_path, $cookie_domain, $cookie_secure, $cookie_httponly);
                } else {
                    $this->Template->showLightbox = 0;
                }
            }
        }
    }
}
