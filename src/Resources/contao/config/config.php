<?php

$GLOBALS['TL_HOOKS']['generatePage'][] = array('Chibko\Tarteaucitron\CookieCitron', 'addCookieCitronScripts');
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array('Chibko\Tarteaucitron\CookieCitron', 'addCookieCitronBuffer');