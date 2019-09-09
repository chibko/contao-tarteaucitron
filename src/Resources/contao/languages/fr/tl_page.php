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
    'Activer le script Tarte au Citron',
    'Affiche les informations cookies sur le site',
];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_highPrivacy']        = [
    'Désactiver le consentement implicite',
    'Désactiver le consentement implicite (en naviguant)',
];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_adblocker']        = [
    'Ad blocker',
    'Cochez cette case pour afficher un message si un adblocker est détecté',
];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_cookieslist']        = [
    'Liste des cookies installés',
    'Cochez cette case pour afficher la liste des cookies installés',
];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_removeCredit']        = [
    'Supprimer crédits',
    'Cochez cette case pour supprimer le lien vers le site tarte au citron',
];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_showAlertSmall']        = [
    'Bandeau bas',
    'Cochez cette case pour afficher le petit bandeau en bas à droite',
];

$GLOBALS['TL_LANG']['tl_page']['cookiecitron_position']      = ['Position de la barre', 'Choisissez où afficher la barre : Haut ou bas'];

$GLOBALS['TL_LANG']['tl_page']['cookiecitron_placement']     = [
    'Placement du code dans le DOM',
    'Choisissez le placement du code dans la structure du DOM.',
];
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_combineAssets'] = [
    'Combiner les CSS',
    'Combine et compresse la feuille de style tarteaucitron.css avec les autres CSS.',
];


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_legend'] = 'Informations sur les cookies';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_position']['top']             = 'Haut de page';
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_position']['bottom']          = 'Bas de page';
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_placement']['before_wrapper'] = 'Avant la balise #wrapper';
$GLOBALS['TL_LANG']['tl_page']['cookiecitron_placement']['body_end']       = 'Avant la balise de fin &lt;body&gt;';
