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
    $GLOBALS['TL_HOOKS']['getContentElement'][] = array('mhg\Elements', 'getContentElement');
    $GLOBALS['TL_HOOKS']['parseTemplate'][] = array('mhg\Elements', 'parseTemplate');
    $GLOBALS['TL_HOOKS']['parseFrontendTemplate'][] = array('mhg\Elements', 'parseFrontendTemplate');
}


/**
 * Register content modules
 */
$GLOBALS['TL_CTE']['Custom Elements']['exitIntentStart'] = 'mhg\ExitIntentStart';
$GLOBALS['TL_CTE']['Custom Elements']['exitIntentStop'] = 'mhg\ExitIntentStop';


/**
 * add Wrapper elements
 */
$GLOBALS['TL_WRAPPERS']['start'][] = 'exitIntentStart';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'exitIntentStop';


$GLOBALS['TL_MHG']['exitintentCookieTimers'] = array(
    '1',
    '2',
    '3',
    '4',
    '5',
    '6',
    '7',
    '10',
    '14',
    '20',
    '30',
    '60',
);


// module specific config
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
