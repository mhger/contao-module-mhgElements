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
 * Register Hooks
 */
$GLOBALS['TL_HOOKS']['getPageLayout'][] = array( 'mhg\ElementsHooks', 'getPageLayout' );

/**
 * Module specific config
 */
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
    '9'
);
