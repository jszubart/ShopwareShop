<?php

namespace VirtuaTechnology\Subscriber;

use Enlight\Event\SubscriberInterface;

class TechnologySubscriber implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Action_PostDispatchSecure_Backend_VirtuaTechnology' => 'virtuaTechnologyBackendDisplay',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'virtuaTechnologyFrontendDisplay',
        );
    }

    public function virtuaTechnologyBackendDisplay(\Enlight_Event_EventArgs $args)
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

    public function virtuaTechnologyFrontendDisplay(\Enlight_Controller_ActionEventArgs $args)
    {
        /** @var \Enlight_Controller_Action $controller */
        $view = $args->getSubject()->View();
        $view->addTemplateDir(__DIR__ . '/../Resources/views');
    }
}
