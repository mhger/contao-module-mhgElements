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
    // Modules
    'mhg\ModuleExitIntent' => 'system/modules/mhgElements/modules/ModuleExitIntent.php',
));


/**
 * Register templates
 */
TemplateLoader::addFiles(array(
    // Modules
    'mod_exitintent' => 'system/modules/mhgElements/templates/modules',
    // jQuery
    'j_pageloader' => 'system/modules/mhgElements/templates/jquery',
));
