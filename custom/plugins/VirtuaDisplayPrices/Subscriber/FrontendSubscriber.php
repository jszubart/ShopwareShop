<?php

namespace VirtuaDisplayPrices\Subscriber;

use Enlight\Event\SubscriberInterface;

use Symfony\Component\DependencyInjection\ContainerInterface;

class FrontendSubscriber implements SubscriberInterface

{
    const PLUGIN_NAME = 'VirtuaDisplayPrices';
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onFrontendPricesDisplay',
            'Enlight_Controller_Action_PostDispatchSecure_Widgets' => 'onFrontendPricesDisplay'
        );
    }

    public function onFrontendPricesDisplay(\Enlight_Controller_ActionEventArgs $args)
    {
        /** @var \Enlight_Controller_Action $controller */
        $controller = $args->getSubject();
        $pluginConfig = $this->container->get('shopware.plugin.cached_config_reader')->getByPluginName(self::PLUGIN_NAME);

        $controller->View()->addTemplateDir(__DIR__ . '/../Resources/views');

        $controller->View()->assign('sUserLoggedIn', Shopware()->Session()->sUserId);
        $controller->View()->assign('hidePrices', $pluginConfig['HidePricesForAnonymousUsers']);

    }
}