<?php

namespace VirtuaFeaturedProducts;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * Shopware-Plugin VirtuaFeaturedProducts.
 */
class VirtuaFeaturedProducts extends Plugin
{
    /**
     * Adds the widget to the database and creates the database schema.
     *
     * @param Plugin\Context\InstallContext $installContext
     */
    public function install(Plugin\Context\InstallContext $installContext)
    {
        $service = $this->container->get('shopware_attribute.crud_service');
        $service->update('s_articles_attributes', 'is_featured', 'boolean', [
            'displayInBackend' => true,
            'label' => 'Featured Product'
        ], null , false , false);

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
        if($uninstallContext->keepUserData()){
            return;
        }

        $service = $this->container->get('shopware_attribute.crud_service');
        $attributeExists = $service->get('s_articles_attributes', 'featured_product');

        if($attributeExists === null) {
            return;
        }

        $service->delete('s_articles_attributes','featured_product');
        $this->container->get('models')->generateAttributeModels(['s_articles_attributes']);
        $uninstallContext->scheduleClearCache(Plugin\Context\UninstallContext::CACHE_LIST_ALL);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onFrontendPostDispatch'
        ];
    }

    /**
     * @param \Enlight_Controller_ActionEventArgs $args
     */
    public function onFrontendPostDispatch(\Enlight_Controller_ActionEventArgs $args)
    {
        $view = $args->getSubject()->View();
        $view->addTemplateDir($this->getPath() . '/Resources/views');
    }

}
