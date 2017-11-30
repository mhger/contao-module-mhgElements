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


/**
 * Module Exit Intent Layer / Popup
 */
class ModuleExitIntent extends \Module {

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_exitintent';

    /**
     * Do not display the module if there are no menu items
     *
     * @return string
     */
    public function generate() {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['exitintent'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        /**
         * @todo    remove or change parama time()
         */
        $GLOBALS['TL_CSS'][] = 'system/modules/mhgElements/assets/css/exitintent.css?v=' . time(); #||static';
        $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mhgElements/assets/js/jquery.exitintent.js?v=' . time(); #|static';        

        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile() {
        $objVars = (object) array(
                    'steps' => $this->exitintent_steps,
                    'delay' => $this->exitintent_delay,
                    'distance' => $this->exitintent_distance,
                    'scroll' => $this->exitintent_scroll,
                    'cookie' => $this->exitintent_cookie,
                    'timer' => $this->exitintent_timer
        );

        $this->Template->vars = htmlspecialchars(json_encode($objVars));
        $this->Template->article = '{{insert_article::' . $this->articleID . '}}';
        $this->Template->showLightbox = 1;

        // cookie handling
        if ($objVars->cookie) {
            $intCookieDays = $objVars->cookie;
            $intCookieExpire = time() + ( 86400 * $intCookieDays );
            $strCookieName = 'exitintentCookie' . $this->id;
            $strCookiePath = '';
            $strCookieDomain = '';
            $strCookieSecure = '';
            $strCookieHttponly = '';


            if (isset($_COOKIE[$strCookieName])) {
                //current time larger than expiration date -> show lightbox and set cookie again
                if (time() >= $_COOKIE[$strCookieName]) {
                    $this->Template->showLightbox = 1;
                    setcookie($strCookieName, $intCookieExpire, $intCookieExpire, $strCookiePath, $strCookieDomain, $strCookieSecure, $strCookieHttponly);
                } else {
                    $this->Template->showLightbox = 0;
                }
            } else {
                setcookie($strCookieName, $intCookieExpire, $intCookieExpire, $strCookiePath, $strCookieDomain, $strCookieSecure, $strCookieHttponly);
                $this->Template->showLightbox = 1;
            }
        }
    }
}
