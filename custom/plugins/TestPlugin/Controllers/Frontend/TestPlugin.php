<?php

/**
 * Frontend controller
 */
class Shopware_Controllers_Frontend_TestPlugin extends Enlight_Controller_Action
{
    public function indexAction()
    {
        $this->View()->assign('name', 'TestPlugin');
    }
}
