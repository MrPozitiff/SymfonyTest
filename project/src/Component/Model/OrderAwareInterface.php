<?php

namespace App\Component\Model;

/**
 * Interface OrderAwareInterface
 */
interface OrderAwareInterface
{
    /**
     * @return OrderInterface|null
     */
    public function getOrder(): ?OrderInterface;

    /**
     * @param OrderInterface|null $order
     */
    public function setOrder(?OrderInterface $order): void;
}
