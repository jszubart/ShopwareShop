<?php

namespace DisplayPricesPlugin;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * Shopware-Plugin DisplayPricesPlugin.
 */
class DisplayPricesPlugin extends Plugin
{
    /**
     * Adds the widget to the database and creates the database schema.
     *
     * @param Plugin\Context\InstallContext $installContext
     */
    public function install(Plugin\Context\InstallContext $installContext)
    {
        parent::install($installContext);
    }

    /**
     * Remove widget and remove database schema.
     *
     * @param Plugin\Context\UninstallContext $uninstallContext
     */
    public function uninstall(Plugin\Context\UninstallContext $uninstallContext)
    {
        parent::uninstall($uninstallContext);
    }

}
