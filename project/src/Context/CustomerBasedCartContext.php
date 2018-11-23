<?php

namespace App\Context;

use App\Component\Model\OrderInterface;
use App\Repository\Order\OrderRepository;

class CustomerBasedCartContext implements CartContextInterface
{
    /**
     * @var CustomerContext
     */
    private $customerContext;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * CustomerBasedCartContext constructor.
     *
     * @param CustomerContext $customerContext
     * @param OrderRepository $orderRepository
     */
    public function __construct(CustomerContext $customerContext, OrderRepository $orderRepository) {
        $this->customerContext = $customerContext;
        $this->orderRepository = $orderRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getCart(): OrderInterface
    {
        $customer = $this->customerContext->getCustomer();
        if (null === $customer) {
            throw new CartNotFoundException('Not able to find the cart, as there is no logged in user.');
        }

        $cart = $this->orderRepository->findLatestCartByCustomer($customer);
        if (null === $cart) {
            throw new CartNotFoundException('Not able to find the cart for currently logged in user.');
        }

        return $cart;
    }
}
