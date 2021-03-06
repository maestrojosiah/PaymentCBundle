<?php

namespace Maestrojosiah\Payment\CoreBundle\Tests\Plugin;

use Maestrojosiah\Payment\CoreBundle\BrowserKit\Request;

class GatewayPluginTest extends \PHPUnit_Framework_TestCase
{
    public function testRequest()
    {
        if (!extension_loaded('curl')) {
            $this->markTestSkipped('cURL is not loaded.');
        }

        $plugin = $this->getPlugin();

        // not sure if there is a better approach to testing this
        $request = new Request('https://raw.githubusercontent.com/schmittjoh/MaestrojosiahPaymentCoreBundle/master/Tests/Plugin/Fixtures/sampleResponse', 'GET');
        $response = $plugin->request($request);

        $this->assertEquals(file_get_contents(__DIR__.'/Fixtures/sampleResponse'), $response->getContent());
        $this->assertEquals(200, $response->getStatus());
    }

    protected function getPlugin()
    {
        return $this->getMockForAbstractClass('Maestrojosiah\Payment\CoreBundle\Plugin\GatewayPlugin', array(true));
    }
}
