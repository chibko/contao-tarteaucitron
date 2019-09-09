<?php

/**
 * cookiebar extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog
 *
 * @package cookiebar
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_enable']        = [
    'Enable cookie bar',
    'Display the cookie information bar on the website.',
];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_message']       = [
    'Cookies information',
    'Please enter a short information about the cookies.',
];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_jumpTo']        = [
    'Details page',
    'Here you can choose the page with more information about the cookies.',
];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_position']      = ['Bar position', 'Here you can choose the bar position.'];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_placement']     = [
    'Bar placement in DOM',
    'Here you can choose the bar placement in DOM structure.',
];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_button']        = [
    'Button label',
    'Please enter the button label (e.g. <em>Accept</em>).',
];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_combineAssets'] = [
    'Combine assets',
    'Adds the cookiebar CSS and JS assets to the combined file.',
];


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_legend'] = 'Cookie information';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_position']['top']             = 'Top of the page';
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_position']['bottom']          = 'Bottom of the page';
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_placement']['before_wrapper'] = 'Before the #wrapper';
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_placement']['body_end']       = 'Before &lt;body&gt; end';
