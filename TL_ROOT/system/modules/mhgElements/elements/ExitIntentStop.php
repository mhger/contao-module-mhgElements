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


class ExitIntentStop extends \ContentElement {

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_exitintent_stop';

    /**
     * Generate the content element
     */
    protected function compile() {
        if (TL_MODE == 'BE') {
            $this->strTemplate = 'be_wildcard';

            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate($this->strTemplate);

            $this->Template = $objTemplate;
//                        $this->Template->title = $this->mooHeadline;
        }

        // Previous and next labels
        $this->Template->previous = $GLOBALS['TL_LANG']['MSC']['previous'];
        $this->Template->next = $GLOBALS['TL_LANG']['MSC']['next'];
    }
}
