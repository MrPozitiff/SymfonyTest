<?php

namespace App\Context;

use App\Component\Model\OrderInterface;
use App\Order\CartSessionStorage;

/**
 * Class SessionBasedCartContext
 */
class SessionBasedCartContext implements CartContextInterface
{
    /**
     * @var CartSessionStorage
     */
    private $cartStorage;

    /**
     * SessionBasedCartContext constructor.
     *
     * @param CartSessionStorage $cartStorage
     */
    public function __construct(CartSessionStorage $cartStorage)
    {
        $this->cartStorage = $cartStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function getCart(): OrderInterface
    {
        if (!$this->cartStorage->hasCart()) {
            throw new CartNotFoundException('Not able to find the cart in session');
        }

        $cart = $this->cartStorage->getCart();
        if (null === $cart) {
            $this->cartStorage->removeCart();

            throw new CartNotFoundException('Not able to find the cart in session');
        }

        return $cart;
    }
}
