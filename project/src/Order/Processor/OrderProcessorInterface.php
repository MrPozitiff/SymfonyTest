<?php

namespace App\Order\Processor;

use App\Component\Model\OrderInterface;

/**
 * Interface OrderProcessorInterface
 */
interface OrderProcessorInterface
{
    /**
     * @param OrderInterface $order
     */
    public function process(OrderInterface $order): void;
}
