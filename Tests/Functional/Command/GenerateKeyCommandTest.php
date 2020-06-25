<?php

namespace Maestrojosiah\Payment\CoreBundle\Tests\Command;

use Maestrojosiah\Payment\CoreBundle\Command\GenerateKeyCommand;
use Maestrojosiah\Payment\CoreBundle\Cryptography\DefusePhpEncryptionService;
use Maestrojosiah\Payment\CoreBundle\Tests\Functional\BaseTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GenerateKeyCommandTest extends BaseTestCase
{
    public function setUp()
    {
        self::createKernel();

        $application = new Application(self::$kernel);
        $application->add(new GenerateKeyCommand());

        $this->command = $application->find('maestrojosiah_payment_core:generate-key');

        parent::setUp();
    }

    /**
     * @runInSeparateProcess
     */
    public function testGeneration()
    {
        $key = trim($this->execute(array()));

        $cipher = new DefusePhpEncryptionService($key);

        $this->assertNotEmpty($key);
        $this->assertEquals('foo', $cipher->decrypt($cipher->encrypt('foo')));
    }

    private function execute(array $input)
    {
        $commandTester = new CommandTester($this->command);

        $commandTester->execute(array_merge(array(
            'command' => $this->command->getName(),
        ), $input));

        return $commandTester->getDisplay();
    }
}
