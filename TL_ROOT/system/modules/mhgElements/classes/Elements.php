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

            if (in_array('j_pageloader', $arrJquery)) {
                $GLOBALS['TL_CSS'][] = 'system/modules/mhgElements/assets/css/pageloader.css||static';
            }

            // add JS & CSS files static to be compressed
            $GLOBALS['TL_CSS'][] = 'system/modules/mhgElements/assets/css/animate.css||static';
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mhgElements/assets/js/jquery.waypoint.js|static';
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mhgElements/assets/js/jquery.animate.js|static';


            $GLOBALS['TL_CSS'][] = 'system/modules/mhgElements/assets/css/exitintent.css||static';
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mhgElements/assets/js/jquery.exitintent.js|static';
        }
    }

    /**
     * Hook.
     * 
     * @param   object $objTemplate
     * @return  void
     */
    public function parseTemplate($objTemplate) {
        $strTemplate = $objTemplate->getName();

        // continue only for supported elements / templates
        if (!in_array($strTemplate, array('ce_headline', 'ce_text', 'ce_image'))) {
            return;
        }

        /**
         * Add animation classes - differs by content type
         */
        $strHeadlineAnimationClass = $this->getAnimationClass($objTemplate, 'headline');
        $strImageAnimationClass = $this->getAnimationClass($objTemplate, 'image');
        $strTextAnimationClass = $this->getAnimationClass($objTemplate, 'text');

        // headlines
        if (0 === strpos($strTemplate, 'ce_headline')) {
            $objTemplate->class.= $strHeadlineAnimationClass;
        } elseif (0 === strpos($strTemplate, 'ce_text')) {
            // wrap text and add animation class
            $objTemplate->text = '<div class="text_container' . $strTextAnimationClass . '">' . $objTemplate->text . '</div>';
            // add image animation class
            $objTemplate->floatClass.= $strImageAnimationClass;
        }

        /**
         * Add animation css classes also into the template object for individual use (fe. custom or modified templates)
         */
        $objTemplate->headlineAnimationClass = $strHeadlineAnimationClass;
        $objTemplate->imageAnimationClass = $strImageAnimationClass;
        $objTemplate->textAnimationClass = $strTextAnimationClass;
    }

    /**
     * 
     * @param   string $strContent
     * @param   string $strTemplate
     * @return  string
     */
    public function parseFrontendTemplate($strContent, $strTemplate) {
        if ($strTemplate == 'fe_page') {

            // add addintional classes for sections to provided better css styling
            $arrSections = array('header', 'main', 'left', 'right', 'footer', 'container','wrapper');

            foreach ($arrSections as $section) {
                $search = ' id="' . $section . '">';
                $replace = '  id="' . $section . '" class="section_' . $section . '">';
                $strContent = str_replace($search, $replace, $strContent);
            }
        }

        return $strContent;
    }

    /**
     * Hook.
     * 
     * @param   object $objTemplate
     * @param   string $strBuffer
     * @return  string
     */
    public function getContentElement($objElement, $strBuffer) {
        $strType = $objElement->typePrefix . $objElement->type;

        // add headline animations
        if (in_array($strType, array('ce_text', 'ce_image'))) {
            $strHeadlineAnimationClass = $this->getAnimationClass($objElement, 'headline');
            $arrHeadline = unserialize($objElement->headline);


            if ($strHeadlineAnimationClass && !empty($arrHeadline['value'])) {
                $search = '<' . $arrHeadline['unit'] . '>' . $arrHeadline['value'];
                $replace = '<' . $arrHeadline['unit'] . ' class="' . $strHeadlineAnimationClass . '">' . $arrHeadline['value'];
                $strBuffer = str_replace($search, $replace, $strBuffer);
            }
        }

        // add image animations
        if (in_array($strType, array('ce_image'))) {
            $strImageAnimationClass = $this->getAnimationClass($objElement, 'image');

            if ($strImageAnimationClass) {
                $search = 'class="image_container"';
                $replace = 'class="image_container' . $strImageAnimationClass . '"';
                $strBuffer = str_replace($search, $replace, $strBuffer);
            }
        }

        return $strBuffer;
    }

    /**
     * @param   object $objElement
     * @param   string $type
     * @return  string
     */
    protected function getAnimationClass($objElement, $type) {
        $strClass = '';
        $strType = $type . 'AnimationType';
        $strTypeDelay = $type . 'AnimationDelay';
        $strTypeOnce = $type . 'AnimationOnce';

        if (!$objElement->$strType || !in_array($type, array('headline', 'text', 'image'))) {
            return '';
        }

        // generate css animation class
        if ($objElement->$strType === 'random') {
            $types = $GLOBALS['TL_MHG']['animationTypes'];
            unset($types['random']);
            $strClass.= ' animate_' . $types[array_rand($types)];
        } else {
            $strClass.= ' animate_' . $objElement->$strType;
        }

        if ($objElement->$strTypeDelay) {
            $strClass.= ' d' . $objElement->$strTypeDelay;
        }

        if ($objElement->$strTypeOnce) {
            $strClass.= ' animateOnce';
        }

        return $strClass;
    }
}
