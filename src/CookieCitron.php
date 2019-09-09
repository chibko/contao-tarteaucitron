<?php

namespace Chibko\Contao\Tarteaucitron;

/**
 * Extension version
 */
class CookieCitron extends \Frontend
{

	/**
	 * Add the cookie information scripts
	 */
	public function addCookieCitronScripts()
	{
		if ($this->isCookieCitronEnabled())
		{
            $flag = '';
            $rootDir = \System::getContainer()->getParameter('kernel.project_dir');
            // Combine the assets
            if ($this->getCurrentRootPage()->cookiecitron_combineAssets) {
                $flag = '|static';
            }
			$GLOBALS['TL_CSS'][] = 'system/modules/xCookiesCitron/assets/css/tarteaucitron.css|all'.$flag;
            //$GLOBALS['TL_HEAD'][]='<script src="'.TL_ASSETS_URL.'system/modules/xCookiesCitron/assets/tarteaucitron.js"></script>';
            $GLOBALS['TL_HEAD'][]=\Template::generateScriptTag($rootDir.'/vendor/chibko/contao/tarteaucitron/src/Resources/public/tarteaucitron.js');
		}
	}


	/**
	 * Add the cookie HTML buffer
	 * @param string
	 * @return string
	 */
	public function addCookieCitronBuffer($strContent)
	{
		if ($this->isCookieCitronEnabled())
		{
			$objRoot = $this->getCurrentRootPage();
			$objTemplate = new \FrontendTemplate('cookiecitron_default');
            
            $objTemplate->highPrivacy = ($objRoot->cookiecitron_highPrivacy) ? 'true' : 'false';
            $objTemplate->adblocker = ($objRoot->cookiecitron_adblocker) ? 'true' : 'false';
            $objTemplate->showAlertSmall = ($objRoot->cookiecitron_showAlertSmall) ? 'true' : 'false';
            $objTemplate->cookieslist = ($objRoot->cookiecitron_cookieslist) ? 'true' : 'false';
            $objTemplate->removeCredit = ($objRoot->cookiecitron_removeCredit) ? 'true' : 'false';
			$objTemplate->position = $objRoot->cookiecitron_position;
            $objTemplate->language = $objRoot->language;
            
            $urlPrivacy="";
            if ($objRoot->url_privacy!==null) : 
           		$pagePrivacy = \PageModel::findWithDetails($objRoot->url_privacy);
           		$urlPrivacy=$pagePrivacy->getFrontendUrl();
           		
           	endif;
           	$objTemplate->url_privacy = $urlPrivacy;	
            
            
            
			// Place the cookiebar in DOM structure
			if ($objRoot->cookiecitron_placement === 'before_wrapper') {
				$strContent = str_replace('<div id="wrapper">', $objTemplate->parse() . '<div id="wrapper">', $strContent);
			} else {
				$strContent = str_replace('</body>', $objTemplate->parse() . '</body>', $strContent);
			}
		}
		
		return $strContent;
	}


	/**
	 * Modify the cached key
	 *
	 * @param string $key
	 *
	 * @return string
	 */
	public function modifyCacheKey($key)
	{
		if ($GLOBALS['objPage']->rootId) {
			// The page is being cached
			$rootPage = \PageModel::findByPk($GLOBALS['objPage']->rootId);
		} else {
			// Page loaded from cache, global $objPage not available
			$rootPage = \PageModel::findFirstPublishedRootByHostAndLanguage(\Environment::get('host'), $GLOBALS['TL_LANGUAGE']);
		}

		if ($rootPage !== null) {
			$key.= $this->isCookieCitronEnabled($rootPage) ? '_cookiecitron' : '';
		}
		return $key;
	}


	/**
	 * Check whether the cookiebar is enabled and should be displayed
	 *
	 * @param \PageModel $rootPage
	 *
	 * @return boolean
	 */
	protected function isCookieCitronEnabled(\PageModel $rootPage = null)
	{
		$objRoot = ($rootPage !== null) ? $rootPage : $this->getCurrentRootPage();
                
		//if ($objRoot->cookiecitron_enable && !\Input::cookie($this->getCookieCitronName($objRoot)))
        if ($objRoot->cookiecitron_enable)
        {
			return true;
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

		if (!\Cache::has($strKey))
		{
			\Cache::set($strKey, \PageModel::findByPk($objPage->rootId));
		}
		return \Cache::get($strKey);
	}

}
