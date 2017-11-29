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
mhg\Dca::modifyPalettes(',headline', ',headline,headlineAnimationType,headlineAnimationDelay,headlineAnimationOnce', 'tl_content');
mhg\Dca::modifyPalettes(',text', ',text,textAnimationType,textAnimationDelay,textAnimationOnce', 'tl_content');

mhg\Dca::modifyPalettes(',fullsize', ',fullsize,imageAnimationType,imageAnimationDelay,imageAnimationOnce', 'tl_content');
mhg\Dca::modifySubpalettes(',fullsize', ',fullsize,imageAnimationType,imageAnimationDelay,imageAnimationOnce', 'tl_content');

/**
 * add DCA palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['exitIntentStart'] = '{type_legend},type;{exitintent_legend},exitintent_steps,exitintent_delay;'
        . '{exitintent_pos_legend},exitintent_top,exitintent_top_size,exitintent_bottom,exitintent_bottom_size,exitintent_left,exitintent_left_size,'
        . 'exitintent_right,exitintent_right_size,exitintent_square,exitintent_square_top;{exitintent_cookie_legend},exitintent_cookie_activate,exitintent_cookie_timer;{expert_legend:hide},cssID;';
$GLOBALS['TL_DCA']['tl_content']['palettes']['exitIntentStop'] = '{type_legend},type;';


/**
 * add DCA fields
 */
mhg\Dca::addField('tl_content', 'exitintent_steps', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_steps'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => true, 'rgxp' => 'digit', 'maxlength' => 2, 'tl_class' => 'w50'),
    'sql' => "varchar(2) NOT NULL default '1'"
));

mhg\Dca::addField('tl_content', 'exitintent_delay', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_delay'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => true, 'rgxp' => 'digit', 'maxlength' => 8, 'tl_class' => 'w50'),
    'sql' => "varchar(8) NOT NULL default '400'"
));

mhg\Dca::addField('tl_content', 'exitintent_top', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_top'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 m12'),
    'sql' => "char(1) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'exitintent_top_size', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_top_size'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 8, 'tl_class' => 'w50'),
    'sql' => "varchar(8) NOT NULL default '80'"
));

mhg\Dca::addField('tl_content', 'exitintent_bottom', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_bottom'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 m12'),
    'sql' => "char(1) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'exitintent_bottom_size', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_bottom_size'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 8, 'tl_class' => 'w50'),
    'sql' => "varchar(8) NOT NULL default '80'"
));

mhg\Dca::addField('tl_content', 'exitintent_left', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_left'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 m12'),
    'sql' => "char(1) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'exitintent_left_size', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_left_size'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 8, 'tl_class' => 'w50'),
    'sql' => "varchar(8) NOT NULL default '80'"
));

mhg\Dca::addField('tl_content', 'exitintent_right', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_right'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 m12'),
    'sql' => "char(1) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'exitintent_right_size', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_right_size'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 8, 'tl_class' => 'w50'),
    'sql' => "varchar(8) NOT NULL default '80'"
));

mhg\Dca::addField('tl_content', 'exitintent_square', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_square'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 m12'),
    'sql' => "char(1) NOT NULL default ''"
));

mhg\Dca::addField('tl_content', 'exitintent_square_top', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_square_top'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'maxlength' => 8, 'tl_class' => 'w50'),
    'sql' => "varchar(8) NOT NULL default '400'"
));

mhg\Dca::addField('tl_content', 'exitintent_cookie_activate', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_cookie_activate'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 m12'),
    'sql' => "char(1) NOT NULL default '0'"
));

mhg\Dca::addField('tl_content', 'exitintent_cookie_timer', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['exitintent_cookie_timer'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array('tl_content_mhgElements', 'getExitintentTimer'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array('tl_class' => 'w50'),
    'sql' => "char(1) NOT NULL default '1'"
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

mhg\Dca::addField('tl_content', 'headlineAnimationOnce', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['headlineAnimationOnce'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 m12'),
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

mhg\Dca::addField('tl_content', 'textAnimationOnce', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['textAnimationOnce'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 m12'),
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

mhg\Dca::addField('tl_content', 'imageAnimationOnce', array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['imageAnimationOnce'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 m12'),
    'sql' => "char(1) NOT NULL default ''"
));


/**
 *  Extended tl_content class [mhgElements]
 */
class tl_content_mhgElements extends tl_content {

    public function getExitintentTimer() {
        $cookieTimers = array(
            '' => '---'
        );

        foreach ($GLOBALS['TL_MHG']['exitintentCookieTimers'] as $type) {
            $cookieTimers[$type] = &$GLOBALS['TL_LANG']['tl_content']['exitintentCookieTimers'][$type];
        }

        return $cookieTimers;
    }

    /**
     * @param   void
     * @return  array
     */
    public function getAnimations() {
        $animations = array(
            '' => '---'
        );

        foreach ($GLOBALS['TL_MHG']['animationTypes'] as $type) {
            $animations[$type] = &$GLOBALS['TL_LANG']['tl_content']['animationTypes'][$type];
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

        foreach ($GLOBALS['TL_MHG']['animationDelays'] as $type) {
            $delays[$type] = &$GLOBALS['TL_LANG']['tl_content']['animationDelays'][$type];
        }

        return $delays;
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
