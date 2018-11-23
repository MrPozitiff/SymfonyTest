<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Order;

use App\Component\Model\OrderInterface;
use App\Context\CartContextInterface;
use App\Context\CustomerContext;
use App\Repository\Order\OrderRepository;

/**
 * Class CartManager
 */
class CartManager
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var CartContextInterface
     */
    private $cartContext;

    /**
     * @var CartSessionStorage
     */
    private $cartSessionStorage;

    /**
     * @var CustomerContext
     */
    private $customerContext;

    /**
     * CartManager constructor.
     *
     * @param OrderRepository $orderRepository
     * @param CartContextInterface $cartContext
     * @param CartSessionStorage $cartSessionStorage
     * @param CustomerContext $customerContext
     */
    public function __construct(OrderRepository $orderRepository, CartContextInterface $cartContext, CartSessionStorage $cartSessionStorage, CustomerContext $customerContext)
    {
        $this->cartSessionStorage = $cartSessionStorage;
        $this->customerContext = $customerContext;
        $this->cartContext = $cartContext;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return OrderInterface
     */
    public function getCart(): OrderInterface
    {
        return $this->cartContext->getCart();
    }

    /**
     * @param OrderInterface $order
     *
     * @return OrderInterface
     */
    public function saveCart(OrderInterface $order): OrderInterface
    {
        if (null === $order->getCustomer()) {
            $this->assignCartToCurrentUser($order);
        }
        $this->orderRepository->save($order);
        $this->cartSessionStorage->setCart($order);

        return $order;
    }

    /**
     * @param OrderInterface $order
     *
     * @return OrderInterface
     */
    public function assignCartToCurrentUser(OrderInterface $order): OrderInterface
    {
        $customer = $this->customerContext->getCustomer();
        if (null !== $customer) {
            $order->setCustomer($customer);
        }

        return $order;
    }
}
