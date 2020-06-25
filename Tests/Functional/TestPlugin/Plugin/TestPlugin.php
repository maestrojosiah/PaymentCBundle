<?php

namespace Maestrojosiah\Payment\CoreBundle\Tests\Functional\TestPlugin\Plugin;

use Maestrojosiah\Payment\CoreBundle\Plugin\AbstractPlugin;

class TestPlugin extends AbstractPlugin
{
    public function processes($paymentSystemName)
    {
        return 'test_plugin' === $paymentSystemName;
    }
}