<?php

namespace App\Order\Factory;

use App\Component\Model\OptionInterface;
use App\Component\Model\OrderItemInterface;
use App\Component\Model\ProductInterface;
use App\Entity\Order\OrderItem;
use Sylius\Component\Resource\Factory\FactoryInterface;

class CartItemFactory implements FactoryInterface
{
    /**
     * @var string
     */
    private $useBeforeModifier;

    /**
     * @param string $useBeforeModifier
     */
    public function __construct(string $useBeforeModifier)
    {
        $this->useBeforeModifier = $useBeforeModifier;
    }

    /**
     * @param ProductInterface $product
     * @param OptionInterface|null $option
     *
     * @return OrderItemInterface
     */
    public function createForProduct(ProductInterface $product, ?OptionInterface $option = null): OrderItemInterface
    {
        $orderItem = $this->createNew();
        $orderItem->setProduct($product);
        $orderItem->setUseBefore(new \DateTime($this->useBeforeModifier));
        if (null !== $option) {
            $orderItem->addOption($option);
        }

        return $orderItem;
    }

    /**
     * @return OrderItemInterface
     */
    public function createNew()
    {
        return new OrderItem();
    }
}
