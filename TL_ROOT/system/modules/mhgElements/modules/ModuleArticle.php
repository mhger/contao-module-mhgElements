<?php
namespace mhg;

class ModuleArticle extends \Contao\ModuleArticle
    {


    protected function compile()
        {
        parent::compile();
        
        if( $this->layoutType )
            {
            $strClass = $this->cssID[1] ? $this->cssID[1] . ' ' . $this->layoutType : $this->layoutType;
            $this->cssID = array( $this->cssID[0], $strClass );
            }
        }
    }