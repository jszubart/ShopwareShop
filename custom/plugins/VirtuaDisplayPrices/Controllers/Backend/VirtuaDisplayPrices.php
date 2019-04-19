<?php

/**
 * Backend controllers extending from Shopware_Controllers_Backend_Application do support the new backend components
 */
class Shopware_Controllers_Backend_VirtuaDisplayPrices extends Shopware_Controllers_Backend_Application
{
    const PLUGIN_NAME = 'VirtuaDisplayPrices';

    public function productsListAction()
    {
        $pluginConfig = $this->container->get('shopware.plugin.cached_config_reader')->getByPluginName(self::PLUGIN_NAME);

        if($pluginConfig['HidePricesForAnonymousUsers'] == true){
            $hidePrices = $pluginConfig['HidePricesForAnonymousUsers'];
        } else
        {
            exit('nie ma dupy');
        }
    }
}
