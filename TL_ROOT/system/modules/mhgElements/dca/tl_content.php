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
/**
 * alter DCA palettes and subpalettes
 */
// ce_headline
mhg\Dca::modifyPalettes('{template_legend:hide},', '{animation_legend:hide},headlineAnimationType,headlineAnimationDelay,elementAnimationRepeat;{template_legend:hide},', 'tl_content', array('headline'));
// ce_text
mhg\Dca::modifyPalettes('{template_legend:hide},', '{animation_legend:hide},headlineAnimationType,headlineAnimationDelay,textAnimationType,textAnimationDelay,imageAnimationType,imageAnimationDelay,elementAnimationRepeat;{template_legend:hide},', 'tl_content', array('text'));
// ce_image
mhg\Dca::modifyPalettes('{template_legend:hide},', '{animation_legend:hide},headlineAnimationType,headlineAnimationDelay,imageAnimationType,imageAnimationDelay,elementAnimationRepeat;{template_legend:hide},', 'tl_content', array('image'));
// ce_hyperlink
mhg\Dca::modifyPalettes('{template_legend:hide},', '{animation_legend:hide},elementAnimationType,elementAnimationDelay,elementAnimationRepeat;{template_legend:hide},', 'tl_content', array('hyperlink'));

/**
 * add DCA fields
 */
mhg\Dca::addField('tl_content', 'elementAnimationType', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['elementAnimationType'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array('tl_content_mhgElements', 'getAnimationsElement'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array('tl_class' => 'w50'),
    'sql' => "varchar(32) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'elementAnimationDelay', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['elementAnimationDelay'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array('tl_content_mhgElements', 'getAnimationsDelay'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array('tl_class' => 'w50'),
    'sql' => "char(1) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'elementAnimationRepeat', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['elementAnimationRepeat'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 m12'),
    'sql' => "char(1) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'headlineAnimationType', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['headlineAnimationType'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array('tl_content_mhgElements', 'getAnimationsText'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array('tl_class' => 'w50'),
    'sql' => "varchar(32) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'headlineAnimationDelay', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['headlineAnimationDelay'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array('tl_content_mhgElements', 'getAnimationsDelay'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array('tl_class' => 'w50'),
    'sql' => "char(1) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'textAnimationType', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['textAnimationType'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array('tl_content_mhgElements', 'getAnimationsText'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array('tl_class' => 'w50'),
    'sql' => "varchar(32) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'textAnimationDelay', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['textAnimationDelay'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array('tl_content_mhgElements', 'getAnimationsDelay'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array('tl_class' => 'w50'),
    'sql' => "char(1) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'imageAnimationType', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['imageAnimationType'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array('tl_content_mhgElements', 'getAnimationsImages'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array('tl_class' => 'w50 clr'),
    'sql' => "varchar(32) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'imageAnimationDelay', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['imageAnimationDelay'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array('tl_content_mhgElements', 'getAnimationsDelay'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array('tl_class' => 'w50'),
    'sql' => "char(1) NOT NULL default ''"
));


/**
 *  Extended tl_content class [mhgElements]
 */
class tl_content_mhgElements extends tl_content {

    /**
     * @param   void
     * @return  array
     */
    public function getAnimations() {
        $animations = array(
            '' => '---'
        );

        foreach ($GLOBALS['TL_MHG']['animations']['types'] as $type) {
            $animations[$type] = &$GLOBALS['TL_LANG']['tl_content']['animations']['types'][$type];
        }

        return $animations;
    }

    /**
     * @param   void
     * @return  array
     */
    public function getAnimationsDelay() {
        $delays = array(
            '' => '---'
        );

        foreach ($GLOBALS['TL_MHG']['animations']['delays'] as $type) {
            $delays[$type] = &$GLOBALS['TL_LANG']['tl_content']['animations']['delays'][$type];
        }

        return $delays;
    }

    /**
     * @param   void
     * @return  array
     */
    public function getAnimationsElement() {
        $animations = $this->getAnimations();

        return $animations;
    }

    /**
     * @param   void
     * @return  array
     */
    public function getAnimationsText() {
        $animations = $this->getAnimations();

        return $animations;
    }

    /**
     * @param   void
     * @return  array
     */
    public function getAnimationsImages() {
        $animations = $this->getAnimations();

        return $animations;
    }
}
