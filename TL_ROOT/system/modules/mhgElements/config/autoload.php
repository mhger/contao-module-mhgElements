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
 * Register classes
 */
ClassLoader::addClasses(array(
    // Classes
    'mhg\Elements' => 'system/modules/mhgElements/classes/Elements.php',
    // Content elements
    'mhg\ExitIntentStart' => 'system/modules/mhgElements/elements/ExitIntentStart.php',
    'mhg\ExitIntentStop' => 'system/modules/mhgElements/elements/ExitIntentStop.php',
    // Modules
    'mhg\ModuleSearch' => 'system/modules/mhgCore/modules/ModuleSearch.php',
    'mhg\ModuleArticleList' => 'system/modules/mhgCore/modules/ModuleArticleList.php',
));


/**
 * Register templates
 */
TemplateLoader::addFiles(array(
    // frontend
    'fe_page' => 'system/modules/mhgElements/templates/frontend',
    // elements
    'ce_exitintent_start' => 'system/modules/mhgElements/templates/elements',
    'ce_exitintent_stop' => 'system/modules/mhgElements/templates/elements',
    // modules
    'mod_article' => 'system/modules/mhgElements/templates/modules',
    'mod_article_list' => 'system/modules/mhgElements/templates/modules',
    // jQuery
    'jquery_base' => 'system/modules/mhgElements/templates/jquery',
    'j_pageloader' => 'system/modules/mhgElements/templates/jquery',
));
