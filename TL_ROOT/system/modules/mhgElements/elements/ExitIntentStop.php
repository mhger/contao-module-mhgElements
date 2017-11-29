<?php
namespace mhg;

class ExitIntentStop extends \ContentElement
    {

        /**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_exitintent_stop';
    
        
        
        /**
	 * Generate the content element
	 */
	protected function compile()
	{
		if (TL_MODE == 'BE')
		{
			$this->strTemplate = 'be_wildcard';

			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate($this->strTemplate);

			$this->Template = $objTemplate;
//                        $this->Template->title = $this->mooHeadline;
		}

		// Previous and next labels
		$this->Template->previous = $GLOBALS['TL_LANG']['MSC']['previous'];
		$this->Template->next = $GLOBALS['TL_LANG']['MSC']['next'];
	}
    
    
    }