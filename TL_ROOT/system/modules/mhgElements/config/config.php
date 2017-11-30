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
 * Register global hooks
 */
$GLOBALS['TL_HOOKS']['getPageLayout'][] = array('mhg\Elements', 'getPageLayout');


/**
 * Register frontend hooks
 */
if (TL_MODE == 'FE') {
    $GLOBALS['TL_HOOKS']['parseTemplate'][] = array('mhg\Elements', 'parseTemplate');
    $GLOBALS['TL_HOOKS']['parseFrontendTemplate'][] = array('mhg\Elements', 'parseFrontendTemplate');
    $GLOBALS['TL_HOOKS']['getContentElement'][] = array('mhg\Elements', 'getContentElement');
}


/**
 * Register content modules
 */
$GLOBALS['FE_MOD']['Custom Elements']['exitintent'] = 'mhg\ModuleExitIntent';


/**
 * Configuration for animations
 */
$GLOBALS['TL_MHG']['animations'] = array(
    'types' => array(
        'random',
        'bounce',
        'shake',
        'atf',
        'afc',
        'fade',
        'aft',
        'afr',
        'afl',
        'afb',
        'wfc',
        'hfc',
        'rfc',
        'rfl',
        'rfr'
    ),
    'delays' => range(1, 10),
);
