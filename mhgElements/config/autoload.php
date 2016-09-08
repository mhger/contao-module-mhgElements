<?php
/**
 * Contao 3 Extension [mhgElements]
 *
 * Copyright (c) 2016 Medienhaus Gersöne UG | Pierre Gersöne
 *
 * @package     mhgElements
 * @link        http://www.medienhaus-gersoene.de
 * @license     propitary licence
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
    'mhg\ContentText' => 'system/modules/mhgElements/elements/ContentText.php',
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
    'ce_text' => 'system/modules/mhgElements/templates/elements',
    'ce_image' => 'system/modules/mhgElements/templates/elements',
    // modules
    'mod_article' => 'system/modules/mhgElements/templates/modules',
    'mod_article_list' => 'system/modules/mhgElements/templates/modules',
    // jQuery
    'jquery_base' => 'system/modules/mhgElements/templates/jquery',
    'j_pageloader' => 'system/modules/mhgElements/templates/jquery',
    )
);