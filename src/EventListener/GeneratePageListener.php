<?php

namespace Chibko\Tarteaucitron\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Environment;
use Contao\FilesModel;
use Contao\FrontendTemplate;
use Contao\PageModel;
use Contao\System;
use Contao\Template;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class GeneratePageListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("generatePage")
     */
    public function addCookieCitronScripts($objPage, $objLayout, $objPageRegular)
    {
        $objRoot= PageModel::findPublishedById($objPage->rootId);

        if ($objRoot->cookiecitron_enable) {
            $flag = '';
            $assetsDir = 'bundles/chibkotarteaucitron/';

            // Add the CSS
            if ($objRoot->cookiecitron_combineAssets) {
                $flag = '|static';
            }

            // Add the Custom CSS
            if ($objRoot->cookiecitron_custom_css!==null) {
                $customCssFile= FilesModel::findById($objRoot->cookiecitron_custom_css);
                if ($customCssFile!==null) {
                    $customCssPath=$customCssFile->path."|".$customCssFile->tstamp;
                }
            }
            $cssTimestamp = filemtime($assetsDir . 'css/tarteaucitron.min.css');
            if ($objLayout->bootstrap) {
                $GLOBALS['TL_CSS_END'][] = $assetsDir . 'css/tarteaucitron.min.css|'.$cssTimestamp . "|".$flag;
                if (isset($customCssPath)) {
                    $GLOBALS['TL_CSS_END'][] = $customCssPath. $flag;
                }
            } else {
                $GLOBALS['TL_CSS'][] = $assetsDir . 'css/tarteaucitron.min.css|' .$cssTimestamp . "|".$flag;
                if (isset($customCssPath)) {
                    $GLOBALS['TL_CSS'][] = $customCssPath . $flag;
                }
            }

            // Add the JS to the Head Section
            $GLOBALS['TL_HEAD'][] = Template::generateScriptTag($assetsDir.'tarteaucitron.min.js');

            // Set etag
            /*if (System::getContainer()->has('fos_http_cache.http.symfony_response_tagger'))
            {
                $responseTagger = System::getContainer()->get('fos_http_cache.http.symfony_response_tagger');
                $responseTagger->addTags(['tarteaucitron']));
            }*/

        }
    }
}