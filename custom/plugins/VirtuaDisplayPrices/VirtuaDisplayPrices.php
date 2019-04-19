<?php

namespace VirtuaDisplayPrices;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * Shopware-Plugin VirtuaDisplayPrices.
 */
class VirtuaDisplayPrices extends Plugin
{
    /**
     * Adds the widget to the database and creates the database schema.
     *
     * @param Plugin\Context\InstallContext $installContext
     */
    public function install(Plugin\Context\InstallContext $installContext)
    {
        parent::install($installContext);

        $this->createSchema();

    }

    /**
     * Remove widget and remove database schema.
     *
     * @param Plugin\Context\UninstallContext $uninstallContext
     */
    public function uninstall(Plugin\Context\UninstallContext $uninstallContext)
    {
        parent::uninstall($uninstallContext);

        $this->removeSchema();
    }

    /**
    * @param ContainerBuilder $container
    */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('virtua_display_prices.plugin_dir', $this->getPath());
        parent::build($container);
    }

    /**
     * creates database tables on base of doctrine models
     */
    private function createSchema()
    {
        $tool = new SchemaTool($this->container->get('models'));
        $classes = [
            $this->container->get('models')->getClassMetadata(\VirtuaDisplayPrices\Models\DisplayPrices::class)
        ];
        $tool->createSchema($classes);
    }

    private function removeSchema()
    {
        $tool = new SchemaTool($this->container->get('models'));
        $classes = [
            $this->container->get('models')->getClassMetadata(\VirtuaDisplayPrices\Models\DisplayPrices::class)
        ];
        $tool->dropSchema($classes);
    }
}
