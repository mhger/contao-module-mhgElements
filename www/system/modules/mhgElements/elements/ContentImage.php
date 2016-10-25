<?php
namespace mhg;

class ContentImage extends \Contao\ContentImage
    {


    public function compile()
        {
        parent::compile();
            
        // image Animation
        if( $this->imageAnimationType )
            {
            if( $this->imageAnimationType === 'random' )
                {
                $types = $GLOBALS['TL_MHG']['animationTypes'];
                unset( $types['random'] );
                $imageAnimationType = $types[array_rand( $types )];
                }
            else 
                {
                $imageAnimationType = $this->imageAnimationType;
                }


            if( $imageAnimationType === 'parallax' )
                {
                $strAnimation = $imageAnimationType . ' animate';

                $strClass = $this->cssID[1] ? $this->cssID[1] . ' parallax fullsize' : 'parallax fullsize';
                $this->cssID = array( $this->cssID[0], $strClass );
                }
            else
                {
                $strAnimation = 'animate_' . $imageAnimationType;
                }

            if( $this->imageAnimationDelay )
                {
                $strAnimation.= ' d' . $this->imageAnimationDelay;
                }
            
            if( $this->imageAnimationOnce )
                {
                $strAnimation.= ' animateOnce';
                }

            $this->Template->imageAnimationClass = ' ' . $strAnimation;
            }
        }
    }