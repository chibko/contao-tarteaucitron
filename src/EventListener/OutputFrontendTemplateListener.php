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
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;

class OutputFrontendTemplateListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("outputFrontendTemplate")
     */
    public function addCookieCitronBuffer($strContent,$strTemplate)
    {
        global $objPage;
        $objRoot= PageModel::findPublishedById($objPage->rootId);
        if ($objRoot->cookiecitron_enable &&  !$objPage->cookiecitron_remove && strstr($strTemplate, 'fe_page')) {
            $objTemplate = new FrontendTemplate('cookiecitron_default');
            $urlPrivacy = "";

            $objTemplate->highPrivacy = ($objRoot->cookiecitron_highPrivacy) ? 'true' : 'false';
            $objTemplate->adblocker = ($objRoot->cookiecitron_adblocker) ? 'true' : 'false';
            $objTemplate->showAlertSmall = ($objRoot->cookiecitron_showAlertSmall) ? 'true' : 'false';
            $objTemplate->AcceptAllCta = ($objRoot->cookiecitron_AcceptAllCta) ? 'true' : 'false';
            $objTemplate->cookieslist = ($objRoot->cookiecitron_cookieslist) ? 'true' : 'false';
            $objTemplate->removeCredit = ($objRoot->cookiecitron_removeCredit) ? 'true' : 'false';
            $objTemplate->position = $objRoot->cookiecitron_position;
            $objTemplate->language = $objRoot->language;

            if (!empty($objRoot->cookiecitron_url_privacy)) :
                $pagePrivacy = PageModel::findWithDetails($objRoot->cookiecitron_url_privacy);
                if ($pagePrivacy!==null) {
                    $urlPrivacy = $pagePrivacy->getFrontendUrl();
                }
            endif;
            $objTemplate->url_privacy = $urlPrivacy;

            $GLOBALS['TL_HEAD'][]=$objTemplate->parse();

            // Place the cookiebar in DOM structure
            /*if ($objRoot->cookiecitron_placement === 'before_wrapper') {
                $strContent = str_replace('<div id="wrapper">', $objTemplate->parse() . '<div id="wrapper">', $strContent);
            } else {
                $strContent = str_replace('</body>', $objTemplate->parse() . '</body>', $strContent);
            }*/

            // Add the services just before the </body> tag
            $arrServices = deserialize($objRoot->cookiecitron_services,true);$strServices=""; // Check if $arrServices is perfomed in the isCookieCitronEnabled function
            foreach ($arrServices as $service) :
                $serviceTemplate = new FrontendTemplate($service);
                $strServices.="\n".$serviceTemplate->parse();
            endforeach;
            $strContent = str_replace('</body>', $strServices . '</body>', $strContent);

        }
        return $strContent;
    }

}