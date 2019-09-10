<?php

$GLOBALS['TL_HOOKS']['generatePage'][] = array('Chibko\Contao\Tarteaucitron\CookieCitron', 'addCookieCitronScripts');
$GLOBALS['TL_HOOKS']['getCacheKey'][] = array('Chibko\Contao\Tarteaucitron\CookieCitron', 'modifyCacheKey');
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array('Chibko\Contao\Tarteaucitron\CCookieCitron', 'addCookieCitronBuffer');