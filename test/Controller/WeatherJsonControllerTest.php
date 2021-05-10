<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the WeatherJsonController.
 */
class WeatherJsonControllerTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di = $this->di;
        $this->controller = new WeatherJsonController();
        $this->controller->setDI($this->di);
    }



    /**
     * Test IndexAction.
     * @method testIndexAction
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexActionGet();
        $this->assertInternalType("array", $res);
    }
}
