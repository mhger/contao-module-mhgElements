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


class ContentHeadline extends \Contao\ContentHeadline {

    public function compile() {
        parent::compile();

        // headline animation
        if ($this->headlineAnimationType) {
            if ($this->headlineAnimationType === 'random') {
                $types = $GLOBALS['TL_MHG']['animationTypes'];
                unset($types['random']);
                $headlineAnimationType = $types[array_rand($types)];
            } else {
                $headlineAnimationType = $this->headlineAnimationType;
            }

            $strAnimation = 'animate_' . $headlineAnimationType;

            if ($this->headlineAnimationDelay) {
                $strAnimation.= ' d' . $this->headlineAnimationDelay;
            }

//            $strAnimation .= $this->headlineAnimationType . ' animate';

            if ($this->headlineAnimationOnce) {
                $strAnimation.= ' animateOnce';
            }

            $this->Template->headlineAnimationClass = ' ' . $strAnimation;
        }
    }
}
