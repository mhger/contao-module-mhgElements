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


// Register HOOKS
$GLOBALS['TL_HOOKS']['getPageLayout'][] = array('mhg\ElementsHooks', 'getPageLayout');

/** Register Content Module */
$GLOBALS['TL_CTE']['Custom Elements']['exitIntentStart'] = 'mhg\ExitIntentStart';
$GLOBALS['TL_CTE']['Custom Elements']['exitIntentStop'] = 'mhg\ExitIntentStop';

/** Add Wrapper elements */
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
$GLOBALS['TL_MHG']['animationTypes'] = array(
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
);

$GLOBALS['TL_MHG']['animationDelays'] = array(
    '1',
    '2',
    '3',
    '4',
    '5',
    '6',
    '7',
    '8',
    '9',
    '10'
);
