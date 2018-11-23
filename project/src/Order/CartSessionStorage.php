<?php

namespace App\Order;

use App\Component\Model\OrderInterface;
use App\Repository\Order\OrderRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartSessionStorage
{
    private const SESSION_CART_IDENTIFIER = 'zigift_cart_id';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @param SessionInterface $session
     * @param OrderRepository $orderRepository
     */
    public function __construct(SessionInterface $session, OrderRepository $orderRepository) {
        $this->session = $session;
        $this->orderRepository = $orderRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function hasCart(): bool
    {
        return $this->session->has(self::SESSION_CART_IDENTIFIER);
    }

    /**
     * {@inheritdoc}
     */
    public function getCart(): ?OrderInterface
    {
        if (!$this->hasCart()) {
            return null;
        }

        $cartId = $this->session->get(self::SESSION_CART_IDENTIFIER);

        return $this->orderRepository->find($cartId);
    }

    /**
     * {@inheritdoc}
     */
    public function setCart(OrderInterface $cart): void
    {
        $this->session->set(self::SESSION_CART_IDENTIFIER, $cart->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function removeCart(): void
    {
        $this->session->remove(self::SESSION_CART_IDENTIFIER);
    }
}
