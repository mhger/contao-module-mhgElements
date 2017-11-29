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


class ContentImage extends \Contao\ContentImage {

    public function compile() {
        parent::compile();

        // image Animation
        if ($this->imageAnimationType) {
            if ($this->imageAnimationType === 'random') {
                $types = $GLOBALS['TL_MHG']['animationTypes'];
                unset($types['random']);
                $imageAnimationType = $types[array_rand($types)];
            } else {
                $imageAnimationType = $this->imageAnimationType;
            }


            if ($imageAnimationType === 'parallax') {
                $strAnimation = $imageAnimationType . ' animate';

                $strClass = $this->cssID[1] ? $this->cssID[1] . ' parallax fullsize' : 'parallax fullsize';
                $this->cssID = array($this->cssID[0], $strClass);
            } else {
                $strAnimation = 'animate_' . $imageAnimationType;
            }

            if ($this->imageAnimationDelay) {
                $strAnimation.= ' d' . $this->imageAnimationDelay;
            }

            if ($this->imageAnimationOnce) {
                $strAnimation.= ' animateOnce';
            }

            $this->Template->imageAnimationClass = ' ' . $strAnimation;
        }
    }
}
