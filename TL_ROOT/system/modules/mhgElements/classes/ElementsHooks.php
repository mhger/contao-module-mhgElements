<?php
namespace mhg;

class ElementsHooks
    {


    public function getPageLayout( $objPage, $objLayout, $objPage )
        {
        if( $objLayout->addJQuery )
            {
            $arrJquery = deserialize( $objLayout->jquery, true );

            if( !in_array( 'jquery_base', $arrJquery ) )
                {
                array_unshift( $arrJquery, 'jquery_base' );
                $objLayout->jquery = serialize( $arrJquery );
                }

            // add both files static to be compressed
            $GLOBALS['TL_CSS'][] = 'system/modules/mhgElements/assets/css/animate.css||static';
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mhgElements/assets/js/jquery.waypoint.js|static';
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/mhgElements/assets/js/jquery.animate.js|static';
            }

        $objLayout->cssClass.= ' nojs';
        }
    }