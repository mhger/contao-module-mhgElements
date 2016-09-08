<?php
/**
 * Contao 3 Extension [mhgElements]
 *
 * Copyright (c) 2016 Medienhaus Gersöne UG | Pierre Gersöne
 *
 * @package     mhgElements
 * @link        http://www.medienhaus-gersoene.de
 * @license     propitary licence
 */
namespace mhg;

/**
 * Module Class
 */
class ModuleArticle extends \Contao\ModuleArticle {
    protected function compile() {
        parent::compile();
        if ($this->layoutType) {
            $strClass = $this->cssID[1] ? $this->cssID[1] . ' ' . $this->layoutType : $this->layoutType;
            $this->cssID = array($this->cssID[0], $strClass);
        }
    }
}