<?php

namespace Maestrojosiah\Payment\CoreBundle\Tests\Plugin;

use Maestrojosiah\Payment\CoreBundle\Plugin\ErrorBuilder;

class ErrorBuilderTest extends \PHPUnit_Framework_TestCase
{
    private $builder;

    public function testHasErrors()
    {
        $this->assertFalse($this->builder->hasErrors());

        $this->builder->addGlobalError('foo');
        $this->assertTrue($this->builder->hasErrors());
    }

    public function testGetException()
    {
        $this->builder->addDataError('foo', 'bar');
        $this->builder->addGlobalError('baz');

        $ex = $this->builder->getException();
        $this->assertInstanceOf('Maestrojosiah\Payment\CoreBundle\Plugin\Exception\InvalidPaymentInstructionException', $ex);
        $this->assertSame(array('foo' => 'bar'), $ex->getDataErrors());
        $this->assertSame(array('baz'), $ex->getGlobalErrors());
    }

    protected function setUp()
    {
        $this->builder = new ErrorBuilder();
    }
}
