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


class ModuleArticle extends \Contao\ModuleArticle {

    protected function compile() {
        parent::compile();

        if ($this->layoutType) {
            $strClass = $this->cssID[1] ? $this->cssID[1] . ' ' . $this->layoutType : $this->layoutType;
            $this->cssID = array($this->cssID[0], $strClass);
        }
    }
}
