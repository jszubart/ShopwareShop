<?php

namespace VirtuaTechnology\Subscriber;

use Enlight\Event\SubscriberInterface;

class BackendSubscriber implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Action_PostDispatchSecure_Backend_VirtuaTechnology' => 'onTechnologyPostDispatch'
        );
    }

    public function onTechnologyPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Backend_VirtuaTechnology $controller */
        $controller = $args->getSubject();

        $view = $controller->View();
        $request = $controller->Request();

        $view->addTemplateDir(__DIR__ . '/../Resources/views');

        if ($request->getActionName() == 'load') {
            $view->extendsTemplate('backend/virtua_technology/view/detail/window.js');
        }
    }
}
