<?php

namespace TestPlugin\Tests;

use TestPlugin\TestPlugin as Plugin;
use Shopware\Components\Test\Plugin\TestCase;

class PluginTest extends TestCase
{
    protected static $ensureLoadedPlugins = [
        'TestPlugin' => []
    ];

    public function testCanCreateInstance()
    {
        /** @var Plugin $plugin */
        $plugin = Shopware()->Container()->get('kernel')->getPlugins()['TestPlugin'];

        $this->assertInstanceOf(Plugin::class, $plugin);
    }
}
