<?php
namespace mhg;

class ContentHeadline extends \Contao\ContentHeadline
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

//            $strAnimation .= $this->headlineAnimationType . ' animate';

            if( $this->headlineAnimationOnce )
                {
                $strAnimation.= ' animateOnce';
                }

            $this->Template->headlineAnimationClass = ' ' . $strAnimation;
            }
        }
    }