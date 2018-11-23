<?php

namespace App\Order;

use App\Component\Model\OrderInterface;
use App\Component\Model\OrderItemInterface;

/**
 * Interface OrderModifierInterface
 */
interface OrderModifierInterface
{
    /**
     * @param OrderInterface $cart
     * @param OrderItemInterface $cartItem
     */
    public function addToOrder(OrderInterface $cart, OrderItemInterface $cartItem): void;

    /**
     * @param OrderInterface $cart
     * @param OrderItemInterface $item
     */
    public function removeFromOrder(OrderInterface $cart, OrderItemInterface $item): void;
}
