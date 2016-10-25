<?php
namespace mhg;

class ContentText extends \Contao\ContentText
    {

    public function compile()
        {
        parent::compile();
        
        
        // headline animation
        if( $this->headlineAnimationType )
            {
            if( $this->headlineAnimationType === 'random' )
                {
                $types = $GLOBALS['TL_MHG']['animationTypes'];
                unset( $types['random'] );
                $headlineAnimationType = $types[array_rand( $types )];
                }
            else
                {
                $headlineAnimationType = $this->headlineAnimationType;
                }

            $strAnimation = 'animate_' . $headlineAnimationType;

            if( $this->headlineAnimationDelay )
                {
                $strAnimation.= ' d' . $this->headlineAnimationDelay;
                }

            $strAnimation .= $this->headlineAnimationType . ' animate';
                
            if( $this->headlineAnimationOnce )
                {
                $strAnimation.= ' animateOnce';
                }

            $this->Template->headlineAnimationClass = ' ' . $strAnimation;
            }
        
        
        
        // text animation
        if( $this->textAnimationType )
            {
            if( $this->textAnimationType === 'random' )
                {
                $types = $GLOBALS['TL_MHG']['animationTypes'];
                unset( $types['random'] );
                $textAnimationType = $types[array_rand( $types )];
                }
            else
                {
                $textAnimationType = $this->textAnimationType;
                }

            $strAnimation = 'animate_' . $textAnimationType;

            if( $this->textAnimationDelay )
                {
                $strAnimation.= ' d' . $this->textAnimationDelay;
                }
 
            if( $this->textAnimationOnce )
                {
                $strAnimation.= ' animateOnce';
                }
                

            $this->Template->textAnimationClass = ' ' . $strAnimation;
            }


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