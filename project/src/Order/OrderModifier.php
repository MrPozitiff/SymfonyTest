<?php

namespace App\Order;

use App\Component\Model\OrderInterface;
use App\Component\Model\OrderItemInterface;
use App\Order\Processor\OrderProcessorInterface;

/**
 * Class OrderModifier
 */
class OrderModifier implements OrderModifierInterface
{
    /**
     * @var OrderProcessorInterface
     */
    private $orderProcessor;

    /**
     * @param OrderProcessorInterface $orderProcessor
     */
    public function __construct(OrderProcessorInterface $orderProcessor) {
        $this->orderProcessor = $orderProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function addToOrder(OrderInterface $order, OrderItemInterface $item): void
    {
        $order->addItem($item);;
        $this->orderProcessor->process($order);
    }

    /**
     * {@inheritdoc}
     */
    public function removeFromOrder(OrderInterface $order, OrderItemInterface $item): void
    {
        $order->removeItem($item);
        $this->orderProcessor->process($order);
    }
}
