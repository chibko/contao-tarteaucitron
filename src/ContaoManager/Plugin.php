<?php

namespace Chibko\Tarteaucitron\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Chibko\Tarteaucitron\ChibkoContaoTarteaucitronBundle;


class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        $bundle = new BundleConfig(ChibkoTarteaucitronBundle::class);
        $bundle->setLoadAfter([ContaoCoreBundle::class]);

        return [$bundle];
    }
}
