<?php

namespace Maestrojosiah\Payment\CoreBundle\PluginController\Event;

use Maestrojosiah\Payment\CoreBundle\Model\PaymentInstructionInterface;
use Symfony\Component\EventDispatcher\Event;

class PaymentInstructionStateChangeEvent extends Event
{
    private $paymentInstruction;
    private $oldState;

    public function __construct(PaymentInstructionInterface $paymentInstruction, $oldState)
    {
        $this->paymentInstruction = $paymentInstruction;
        $this->oldState = $oldState;
    }

    /**
     * @return \Maestrojosiah\Payment\CoreBundle\Model\PaymentInstructionInterface
     */
    public function getPaymentInstruction()
    {
        return $this->paymentInstruction;
    }

    public function getOldState()
    {
        return $this->oldState;
    }

    public function getNewState()
    {
        return $this->paymentInstruction->getState();
    }
}
