<?php

namespace DeliverPlugin;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\ORM\Tools\SchemaTool;
use DeliveryPlugin\Models\Delivery;

/**
 * Shopware-Plugin DeliveryPlugin.
 */
class DeliveryPlugin extends Plugin
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

        $service = $this->container->get('shopware_attribute.crud_service');

        $service->update('s_articles_attributes', 'shipping_in', 'integer', [
            'displayInBackend' => true,
            'label' => 'Shipping in',
            'helpText' => 'Number of days which will be required to deliver the package',
            'custom' => true
        ], null , true, 1);

        $this->container->get('models')->generateAttributeModels(['s_articles_attributes']);
        $installContext->scheduleClearCache(Plugin\Context\InstallContext::CACHE_LIST_ALL);
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

        $service = $this->container->get('shopware_attribute.crud_service');
        $attributeExists = $service->get('s_articles_attributes', 'shipping_in');

        if($attributeExists === null) {
            return;
        }

        $service->delete('s_articles_attributes','shipping_in');
        $this->container->get('models')->generateAttributeModels(['s_articles_attributes']);
    }

    /**
    * @param ContainerBuilder $container
    */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('delivery_plugin.plugin_dir', $this->getPath());
        parent::build($container);
    }

    /**
     * creates database tables on base of doctrine models
     */
    private function createSchema()
    {
        $tool = new SchemaTool($this->container->get('models'));
        $classes = [
            $this->container->get('models')->getClassMetadata(Delivery::class)
        ];
        $tool->createSchema($classes);
    }

    private function removeSchema()
    {
        $tool = new SchemaTool($this->container->get('models'));
        $classes = [
            $this->container->get('models')->getClassMetadata(Delivery::class)
        ];
        $tool->dropSchema($classes);
    }
}
