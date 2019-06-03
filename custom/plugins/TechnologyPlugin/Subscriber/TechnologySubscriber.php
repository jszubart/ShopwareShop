<?php

namespace TechnologyPlugin\Subscriber;

use Enlight\Event\SubscriberInterface;

class TechnologySubscriber implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Action_PostDispatchSecure_Backend_TechnologyPlugin' => 'TechnologyBackendDisplay',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'TechnologyFrontendDisplay',
        );
    }

    public function TechnologyBackendDisplay(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Backend_TechnologyPlugin $controller */
        $controller = $args->getSubject();

        $view = $controller->View();
        $request = $controller->Request();

        $view->addTemplateDir(__DIR__ . '/../Resources/views');

        if ($request->getActionName() == 'load') {
            $view->extendsTemplate('backend/technology_plugin/view/detail/window.js');
        }
    }

    public function TechnologyFrontendDisplay(\Enlight_Controller_ActionEventArgs $args)
    {
        /** @var \Enlight_Controller_Action $controller */
        $view = $args->getSubject()->View();
        $view->addTemplateDir(__DIR__ . '/../Resources/views');
    }
}
