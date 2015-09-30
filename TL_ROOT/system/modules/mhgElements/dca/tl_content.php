<?php
mhg\Dca::modifyPalettes( ',text', ',text,textAnimationType,textAnimationDelay,textAnimationOnce', 'tl_content' );
mhg\Dca::modifyPalettes( ',fullsize', ',fullsize,imageAnimationType,imageAnimationDelay,imageAnimationOnce', 'tl_content' );
mhg\Dca::modifySubpalettes( ',fullsize', ',fullsize,imageAnimationType,imageAnimationDelay,imageAnimationOnce', 'tl_content' );

mhg\Dca::addField( 'tl_content', 'textAnimationType',
    array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['textAnimationType'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array( 'tl_content_mhgElements', 'getAnimationsText' ),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array( 'tl_class' => 'w50' ),
    'sql' => "varchar(32) NOT NULL default ''"
) );

mhg\Dca::addField( 'tl_content', 'textAnimationDelay',
    array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['textAnimationDelay'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array( 'tl_content_mhgElements', 'getAnimationsDelay' ),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array( 'tl_class' => 'w50' ),
    'sql' => "char(1) NOT NULL default ''"
) );

mhg\Dca::addField( 'tl_content', 'textAnimationOnce',
    array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['textAnimationOnce'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array( 'tl_class' => 'w50 m12' ),
    'sql' => "char(1) NOT NULL default ''"
) );

mhg\Dca::addField( 'tl_content', 'imageAnimationType',
    array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['imageAnimationType'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array( 'tl_content_mhgElements', 'getAnimationsImages' ),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array( 'tl_class' => 'w50 clr' ),
    'sql' => "varchar(32) NOT NULL default ''"
) );

mhg\Dca::addField( 'tl_content', 'imageAnimationDelay',
    array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['imageAnimationDelay'],
    'exclude' => true,
    'default' => '',
    'inputType' => 'select',
    'options_callback' => array( 'tl_content_mhgElements', 'getAnimationsDelay' ),
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => array( 'tl_class' => 'w50' ),
    'sql' => "char(1) NOT NULL default ''"
) );

mhg\Dca::addField( 'tl_content', 'imageAnimationOnce',
    array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['imageAnimationOnce'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array( 'tl_class' => 'w50 m12' ),
    'sql' => "char(1) NOT NULL default ''"
) );

class tl_content_mhgElements extends tl_content
    {


    public function getAnimations()
        {
        $animations = array(
            '' => '---'
        );

        foreach( $GLOBALS['TL_MHG']['animationTypes'] as $type )
            {
            $animations[$type] = &$GLOBALS['TL_LANG']['tl_content']['animationTypes'][$type];
            }

        return $animations;
        }


    public function getAnimationsDelay()
        {
        $delays = array(
            '' => '---'
        );

        foreach( $GLOBALS['TL_MHG']['animationDelays'] as $type )
            {
            $delays[$type] = &$GLOBALS['TL_LANG']['tl_content']['animationDelays'][$type];
            }

        return $delays;
        }


    public function getAnimationsText()
        {
        $animations = $this->getAnimations();

        return $animations;
        }


    public function getAnimationsImages()
        {
        $animations = $this->getAnimations();
        $animations['parallax'] = 'parallax';

        return $animations;
        }
    }