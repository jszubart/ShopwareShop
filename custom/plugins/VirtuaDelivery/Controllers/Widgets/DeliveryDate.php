<?php

/**
 * Frontend controller
 */
class Shopware_Controllers_Widgets_DeliveryDate extends Enlight_Controller_Action
{
    const PLUGIN_NAME = 'VirtuaDelivery';

    public function deliveryInformationAction()
    {
        $pluginConfig = $this->container->get('shopware.plugin.cached_config_reader')->getByPluginName(self::PLUGIN_NAME);

        $notShipping = $pluginConfig['NotShipping'];
        $shipsUntil = date("H:i:s", strtotime($pluginConfig['ShipsUntil']));
        $holidaysBegin = date("Y-m-d", strtotime($pluginConfig['HolidaysBegin']));
        $holidaysEnd = date("Y-m-d", strtotime($pluginConfig['HolidaysEnd']));
        $shippingIn = $this->Request()->getParam('shippingIn');

        $currentDateTime = explode(' ',((new DateTime())->format('Y-m-d H:i:s l')));
        $currentDate = $currentDateTime[0];
        $currentTime = $currentDateTime[1];
        $currentDay = $currentDateTime[2];

        $shippingDate = date("Y-m-d", strtotime($currentDate . '+'.$shippingIn.' days'));

        if($shipsUntil < $currentTime) {
            $shippingDate = date("Y-m-d", strtotime($shippingDate . '+1 day'));
        }

        do
        {
            if($holidaysBegin <= $shippingDate && $holidaysEnd >= $shippingDate){
                $shippingDate = date("Y-m-d", strtotime($holidaysEnd . '+1 day'));
            }

            foreach ($notShipping as $offDay) {
                if(date('l', strtotime($shippingDate)) === $offDay || $currentDay === $offDay){
                    $shippingDate = date("Y-m-d", strtotime($shippingDate . '+1 day'));
                }
            }
        }
        while(in_array(date('l', strtotime($shippingDate)),$notShipping));

        $this->View()->assign('shippingDate', $shippingDate );
        $this->View()->assign('notShipping', $notShipping );
        $this->View()->assign('shipsUntil', $shipsUntil);
        $this->View()->assign('holidaysBegin', $holidaysBegin);
        $this->View()->assign('holidaysEnd', $holidaysEnd);
    }
}