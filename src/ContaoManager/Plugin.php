<?php

namespace Chibko\Contao\Tarteaucitron\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Chibko\Contao\Tarteaucitron\ChibkoContaoTarteaucitronBundle;


class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        $bundle = new BundleConfig(ChibkoContaoTarteaucitronBundle::class);
        $bundle->setLoadAfter([ContaoCoreBundle::class]);

        return [$bundle];
    }
}
