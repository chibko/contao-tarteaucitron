<?php

namespace Chibko\Contao\Tarteaucitron;

use MatthiasMullie\Minify\JS;

class CookieCitron extends \Frontend
{
    /**
     * Add the cookie information scripts
     * @param \PageModel $objPage, \layoutModel $objLayout, \PageRegular $objPageRegular
     */
    public function addCookieCitronScripts($objPage, $objLayout, $objPageRegular)
    {
        if ($this->isCookieCitronEnabled()) {
            $objRoot = $this->getCurrentRootPage();
            $flag = '';
            $assetsDir = 'bundles/chibkocontaotarteaucitron/';

            // Add the CSS
            if ($objRoot->cookiecitron_combineAssets) {
                $flag = '|static';
            }
            if ($objLayout->bootstrap) {
                $GLOBALS['TL_CSS_END'][] = $assetsDir . 'css/tarteaucitron.css|all' . $flag;
            } else {
                $GLOBALS['TL_CSS'][] = $assetsDir . 'css/tarteaucitron.css|all' . $flag;
            }

            // Add the JS to the Head Section
            $GLOBALS['TL_HEAD'][] = \Template::generateScriptTag($assetsDir.'tarteaucitron.min.js');
        }
    }

    /**
     * Add the cookie HTML buffer
     * @param string
     * @return string
     */
    public function addCookieCitronBuffer($strContent,$strTemplate)
    {
        if ($this->isCookieCitronEnabled()) {
            $objRoot = $this->getCurrentRootPage();
            $objTemplate = new \FrontendTemplate('cookiecitron_default');
            $urlPrivacy = "";

            $objTemplate->highPrivacy = ($objRoot->cookiecitron_highPrivacy) ? 'true' : 'false';
            $objTemplate->adblocker = ($objRoot->cookiecitron_adblocker) ? 'true' : 'false';
            $objTemplate->showAlertSmall = ($objRoot->cookiecitron_showAlertSmall) ? 'true' : 'false';
            $objTemplate->AcceptAllCta = ($objRoot->cookiecitron_AcceptAllCta) ? 'true' : 'false';
            $objTemplate->cookieslist = ($objRoot->cookiecitron_cookieslist) ? 'true' : 'false';
            $objTemplate->removeCredit = ($objRoot->cookiecitron_removeCredit) ? 'true' : 'false';
            $objTemplate->position = $objRoot->cookiecitron_position;
            $objTemplate->language = $objRoot->language;

            if (($objRoot->url_privacy)) :
                $pagePrivacy = \PageModel::findWithDetails($objRoot->url_privacy);
                if ($pagePrivacy!==null) {
                    $urlPrivacy = $pagePrivacy->getFrontendUrl();
                }
            endif;
            $objTemplate->url_privacy = $urlPrivacy;

            // Place the cookiebar in DOM structure
            if ($objRoot->cookiecitron_placement === 'before_wrapper') {
                $strContent = str_replace('<div id="wrapper">', $objTemplate->parse() . '<div id="wrapper">', $strContent);
            } else {
                $strContent = str_replace('</body>', $objTemplate->parse() . '</body>', $strContent);
            }
            // Add the services just before the </body> tag
            $arrServices = deserialize($objRoot->cookiecitron_services,true);$strServices=""; // Check if $arrServices is perfomed in the isCookieCitronEnabled function
            foreach ($arrServices as $service) :
                $serviceTemplate = new \FrontendTemplate($service);
                $strServices.="\n".$serviceTemplate->parse();
            endforeach;
            $strContent = str_replace('</body>', $strServices . '</body>', $strContent)
        }

        return $strContent;
    }

    /**
     * Check whether the cookiebar is enabled and should be displayed
     * @param \PageModel $rootPage
     * @return boolean
     */
    protected function isCookieCitronEnabled(\PageModel $rootPage = null)
    {
        $objRoot = ($rootPage !== null) ? $rootPage : $this->getCurrentRootPage();

        if ($objRoot->cookiecitron_enable) {
            $arrServices = deserialize($objRoot->cookiecitron_services, true);
            if (!empty($arrServices)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the current root page and return it
     * @return object
     */
    protected function getCurrentRootPage()
    {
        global $objPage;
        $strKey = 'COOKIECITRON_ROOT_' . $objPage->rootId;

        if (!\Cache::has($strKey)) {
            \Cache::set($strKey, \PageModel::findByPk($objPage->rootId));
        }

        return \Cache::get($strKey);
    }
}
