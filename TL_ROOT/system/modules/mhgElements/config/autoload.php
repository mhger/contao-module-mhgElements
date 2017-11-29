<?php
/**
 * mhgElements Contao 3 Extension
 *
 * @package     mhgElements
 * @link        http://www.medienhaus-gersoene.de
 * @license     propitary
 * @copyright   Copyright (c) 2014
 * @author      Pierre Gersöne <mail@medienhaus-gersoene.de>
 */
/**
 * Register classes
 */
ClassLoader::addClasses( array
    (
    // Classes
    'mhg\Elements' => 'system/modules/mhgElements/classes/Elements.php',
    'mhg\ElementsHooks' => 'system/modules/mhgElements/classes/ElementsHooks.php',
    // Content elements
    'mhg\ContentHeadline' => 'system/modules/mhgElements/elements/ContentHeadline.php',
    'mhg\ContentText' => 'system/modules/mhgElements/elements/ContentText.php',
    'mhg\ContentImage' => 'system/modules/mhgElements/elements/ContentImage.php',
    'mhg\ExitIntentStart' => 'system/modules/mhgElements/elements/ExitIntentStart.php',
    'mhg\ExitIntentStop' => 'system/modules/mhgElements/elements/ExitIntentStop.php',
    // Modules
    'mhg\ModuleArticle' => 'system/modules/mhgElements/modules/ModuleArticle.php',
) );


/**
 * Register templates
 */
TemplateLoader::addFiles( array
    (
    // frontend
    'fe_page' => 'system/modules/mhgElements/templates/frontend',
    // elements
    'ce_headline' => 'system/modules/mhgElements/templates/elements',
    'ce_text' => 'system/modules/mhgElements/templates/elements',
    'ce_image' => 'system/modules/mhgElements/templates/elements',
    'ce_exitintent_start' => 'system/modules/mhgElements/templates/elements',
    'ce_exitintent_stop' => 'system/modules/mhgElements/templates/elements',
    // modules
    'mod_article' => 'system/modules/mhgElements/templates/modules',
    'mod_article_list' => 'system/modules/mhgElements/templates/modules',
    // jQuery
    'jquery_base' => 'system/modules/mhgElements/templates/jquery',
    'j_pageloader' => 'system/modules/mhgElements/templates/jquery',
    )
);