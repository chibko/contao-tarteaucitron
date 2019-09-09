<?php

use \Contao\CoreBundle\DataContainer\PaletteManipulator;

// Add palettes selector
$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'cookiecitron_enable';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['cookiecitron_enable'] = 'url_privacy,cookiecitron_adblocker,cookiecitron_showAlertSmall,cookiecitron_cookieslist,cookiecitron_removeCredit,cookiecitron_position,cookiecitron_placement,cookiecitron_highPrivacy,cookiecitron_combineAssets';

PaletteManipulator::create()
    ->addLegend('cookiecitron_legend', '', PaletteManipulator::POSITION_AFTER)
    ->addField('cookiecitron_enable', 'cookiecitron_legend', PaletteManipulator::POSITION_AFTER)
    ->applyToPalette('root', 'tl_page');
//$GLOBALS['TL_DCA']['tl_page']['palettes']['root'].= ';{cookiecitron_legend},cookiecitron_enable';

/**
 * Add the fields to tl_page
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['cookiecitron_enable'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['cookiecitron_enable'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'long'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['url_privacy'] = array
(
			'label'                   => &$GLOBALS['TL_LANG']['tl_page']['url_privacy'],
			'exclude'                 => true,
			'inputType'               => 'pageTree',
			'foreignKey'              => 'tl_page.title',
			'eval'                    => array('fieldType'=>'radio'), // do not set mandatory (see #5453)
			'save_callback' => array
			(
				array('tl_page', 'checkJumpTo')
			),
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy')
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookiecitron_highPrivacy'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['cookiecitron_highPrivacy'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'long clr'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookiecitron_adblocker'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['cookiecitron_adblocker'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookiecitron_showAlertSmall'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['cookiecitron_showAlertSmall'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookiecitron_cookieslist'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['cookiecitron_cookieslist'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookiecitron_removeCredit'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['cookiecitron_removeCredit'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);


$GLOBALS['TL_DCA']['tl_page']['fields']['cookiecitron_position'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['cookiecitron_position'],
	'default'                 => 'top',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('top', 'bottom'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_page']['cookiecitron_position'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(8) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookiecitron_placement'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['cookiecitron_placement'],
	'default'                 => 'body_end',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('body_end', 'before_wrapper'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_page']['cookiecitron_placement'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(16) NOT NULL default ''"
);


$GLOBALS['TL_DCA']['tl_page']['fields']['cookiecitron_combineAssets'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_page']['cookiecitron_combineAssets'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'long clr'),
    'sql'                     => "char(1) NOT NULL default ''"
);
