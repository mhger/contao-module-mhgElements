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
 * class mhg\Elements
 */
class Elements {

    /**
     * Hook.
     * 
     * @param   object $objPage
     * @param   object $objLayout
     * @param   object $objPage
     * @return  void
     */
    public function getPageLayout($objPage, $objLayout, $objPage) {
        if ($objLayout->addJQuery) {
            $arrJquery = deserialize($objLayout->jquery, true);

            if (!in_array('jquery_base', $arrJquery)) {
                array_unshift($arrJquery, 'jquery_base');
                $objLayout->jquery = serialize($arrJquery);
            }

            // add both files static to be compressed
            $GLOBALS['TL_CSS'][] = 'system/modules/mhgElements/assets/css/animate.css||static';
            $GLOBALS['TL_CSS'][] = 'system/modules/mhgElements/assets/css/exitintent.css||static';
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mhgElements/assets/js/jquery.waypoint.js|static';
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mhgElements/assets/js/jquery.animate.js|static';
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mhgElements/assets/js/jquery.exitintent.js|static';
        }
    }
}
