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
));


/**
 * Register templates
 */
TemplateLoader::addFiles(array(
    // elements
    'ce_exitintent_start' => 'system/modules/mhgElements/templates/elements',
    'ce_exitintent_stop' => 'system/modules/mhgElements/templates/elements',
    // jQuery
    'j_pageloader' => 'system/modules/mhgElements/templates/jquery',
));
