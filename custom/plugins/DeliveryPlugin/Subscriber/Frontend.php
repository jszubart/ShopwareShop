<?php

namespace DeliveryPlugin\Subscriber;

use Enlight\Event\SubscriberInterface;

class Frontend implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onFrontendPostDispatch',
            'Enlight_Controller_Action_PostDispatchSecure_Widgets' => 'onFrontendPostDispatch'
        );
    }

    public function onFrontendPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var $controller \Enlight_Controller_Action */
        $view = $args->getSubject()->View();
        $view->addTemplateDir(__DIR__ . '/../Resources/views');
    }
}
