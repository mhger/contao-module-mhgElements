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
     * Generate the module
     *
     * @param   void
     * @return  string
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
     * 
     * @param   void
     * @return  void
     */
    protected function compile() {
        global $objPage;
        $pageID = $objPage->id;
        $showLayer = 1;

        // cookie handling
        if ($this->exitIntentCookie) {
            $intCookieDays = $this->exitIntentCookie;
            $intCookieExpire = time() + ( 86400 * $intCookieDays );
            $strCookieName = 'exitIntentCookie' . $pageID;
            $strCookiePath = '';
            $strCookieDomain = '';
            $strCookieSecure = '';
            $strCookieHttponly = '';

            if (!isset($_COOKIE[$strCookieName]) || (time() >= $_COOKIE[$strCookieName])) {
                // Sets cookie if there was none or current time larger than expiration date (show lightbox and set cookie again)
                setcookie($strCookieName, $intCookieExpire, $intCookieExpire, $strCookiePath, $strCookieDomain, $strCookieSecure, $strCookieHttponly);
            } else {
                $showLayer = 0;
            }
        }

        // prepare script data
        $objVars = (object) array(
                    'show' => $showLayer,
                    'steps' => $this->exitIntentSteps,
                    'delay' => $this->exitIntentDelay,
                    'edge' => (!$this->exitIntentEdge && !$this->exitIntentScroll && !$this->exitIntentTimer) ? 1 : $this->exitIntentEdge,
                    'scroll' => $this->exitIntentScroll,
                    'timer' => $this->exitIntentTimer,
                    'theme' => $this->exitIntentTheme,
                    'modal' => $this->exitIntentModal,
                    'labelClose' => '{{label::MSC:close}}'
        );

        $this->Template->vars = htmlspecialchars(json_encode($objVars));
        $this->Template->article = '{{insert_article::' . $this->articleID . '}}';
    }
}
