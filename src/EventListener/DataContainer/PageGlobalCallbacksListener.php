<?php

namespace Chibko\Tarteaucitron\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use League\Uri\Data;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;
use Contao\Database;
use Contao\Input;
use Contao\PageModel;
use Contao\System;

class PageGlobalCallbacksListener implements ServiceAnnotationInterface
{
    /**
     * @Callback(target="config.oninvalidate_cache_tags", table="tl_page")
     */
    public function invalidateTags(DataContainer $dc, array $tags)
    {
        // Invalidate tags for root subpage
        $page = PageModel::findByIdOrAlias($dc->id);
        if ($page!==null) {
            if ($page->type=="root") {
                $arrTags=array("contao.db.tl_page");
                $db = Database::getInstance();
                $arrSubPages = $db->getChildRecords($page->id,"tl_page");
                if (is_array($arrSubPages) && !empty($arrSubPages)) {
                    foreach($arrSubPages as $subPage) {
                        $arrTags[]="contao.db.tl_page.".$subPage;
                    }
                    return $arrTags;
                }
            }
        }
        return $tags;
    }
}