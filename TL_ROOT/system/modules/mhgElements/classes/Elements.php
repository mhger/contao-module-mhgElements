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
        if (!in_array($strTemplate, array('ce_headline', 'ce_text', 'ce_image')) && !$objTemplate->elementAnimationType) {
            return;
        }

        /**
         * Add animation classes - differs by content type
         */
        $strElementAnimationClass = $this->getAnimationClass($objTemplate, 'element');
        $strHeadlineAnimationClass = $this->getAnimationClass($objTemplate, 'headline');
        $strImageAnimationClass = $this->getAnimationClass($objTemplate, 'image');
        $strTextAnimationClass = $this->getAnimationClass($objTemplate, 'text');

        if (0 === strpos($strTemplate, 'ce_headline')) {
            $objTemplate->class.= $strHeadlineAnimationClass;
        } elseif (0 === strpos($strTemplate, 'ce_text')) {
            // wrap text and add animation class
            $objTemplate->text = '<div class="text_container' . $strTextAnimationClass . '">' . $objTemplate->text . '</div>';
            // add image animation class
            $objTemplate->floatClass.= $strImageAnimationClass;
        } elseif ($objTemplate->elementAnimationType) {
            $objTemplate->class.= $strElementAnimationClass;
        }

        /**
         * Add animation css classes also into the template object for individual use (fe. custom or modified templates)
         */
        $objTemplate->elementAnimationClass = $strElementAnimationClass;
        $objTemplate->headlineAnimationClass = $strHeadlineAnimationClass;
        $objTemplate->imageAnimationClass = $strImageAnimationClass;
        $objTemplate->textAnimationClass = $strTextAnimationClass;

        // add required JS and CSS files
        if ($strElementAnimationClass || $strHeadlineAnimationClass || $strImageAnimationClass || $strTextAnimationClass) {
            $strFileCss = 'system/modules/mhgElements/assets/css/animate.css||static';
            $strFileJavascript = 'system/modules/mhgElements/assets/js/jquery.animate.js|static';

            if (!in_array($strFileCss, $GLOBALS['TL_CSS'])) {
                $GLOBALS['TL_CSS'][] = $strFileCss;
            }

            if (!in_array($strFileJavascript, $GLOBALS['TL_JAVASCRIPT'])) {
                $GLOBALS['TL_JAVASCRIPT'][] = $strFileJavascript;
            }
        }
    }

    /**
     * 
     * @param   string $strContent
     * @param   string $strTemplate
     * @return  string
     */
    public function parseFrontendTemplate($strContent, $strTemplate) {
        global $objPage;

        if ($strTemplate == 'mod_search') {
            // Add keyword(s) to page title from search,
            // sanitize and remove possible harmful tags
            $strKeywords = trim(\Input::get('keywords'));
            $strKeywords = preg_replace('/\{\{[^\}]*\}\}/', '', $strKeywords);
            $strKeywords = strip_tags(strip_insert_tags($strKeywords));
            $strKeywords = filter_var($strKeywords, FILTER_SANITIZE_STRING);

            if (!empty($strKeywords)) {
                $intPage = 0;
                foreach ($_GET as $key => $value) {
                    if (0 === strpos($key, 'page_s')) {
                        $intPage = intval($value);
                        break;
                    }
                }
                $strTitle = ucwords($strKeywords);
                $strTitle.= $intPage > 1 ? ' - ' . $GLOBALS['TL_LANG']['MSC']['page'] . ' ' . $intPage . ' | ' : ' | ';
                $strTitle.= empty($objPage->pageTitle) ? $objPage->title : $objPage->pageTitle;

                $objPage->pageTitle = $strTitle;
            }
        }

        if ($strTemplate == 'fe_page') {
            // add addintional classes for sections to provided better css styling
            $arrSections = array('header', 'main', 'left', 'right', 'footer', 'container', 'wrapper');

            foreach ($arrSections as $section) {
                $strClass = 'section_' . $section;

                if ($section == 'left') {
                    $strClass.= 'section_sidebar section_sidebar_primary';
                } elseif ($section == 'right') {
                    $strClass.= 'section_sidebar section_sidebar_secondary';
                }

                $search = ' id="' . $section . '">';
                $replace = '  id="' . $section . '" class="' . $strClass . '">';

                $strContent = str_replace($search, $replace, $strContent);
            }
        }

        return $strContent;
    }

    /**
     * Hook.
     * 
     * @param   object $objElement
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

        if (!$objElement->$strType || !in_array($type, array('element', 'headline', 'text', 'image'))) {
            return '';
        }

        // generate css animation class
        if ($objElement->$strType === 'random') {
            $types = $GLOBALS['TL_MHG']['animations']['types'];
            unset($types['random']);
            $strClass.= ' animate_' . $types[array_rand($types)];
        } else {
            $strClass.= ' animate_' . $objElement->$strType;
        }

        if ($objElement->$strTypeDelay) {
            $strClass.= ' d' . $objElement->$strTypeDelay;
        }

        $strClass.= $objElement->elementAnimationRepeat ? '' : ' animateOnce';

        return $strClass;
    }
}
