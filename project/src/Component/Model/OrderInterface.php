<?php

namespace App\Component\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\User\Model\UserInterface;

/**
 * Interface OrderInterface
 */
interface OrderInterface extends
    ResourceInterface,
    TimestampableInterface,
    CustomerAwareInterface
{
    public const STATE_CART = 'cart';
    public const STATE_NEW = 'new';
    public const STATE_CANCELLED = 'cancelled';
    public const STATE_FULFILLED = 'fulfilled';

    /**
     * @return \DateTimeInterface|null
     */
    public function getCheckoutCompletedAt(): ?\DateTimeInterface;

    /**
     * @param \DateTimeInterface|null $checkoutCompletedAt
     */
    public function setCheckoutCompletedAt(?\DateTimeInterface $checkoutCompletedAt): void;

    /**
     * @return bool
     */
    public function isCheckoutCompleted(): bool;

    public function completeCheckout(): void;

    /**
     * @return string|null
     */
    public function getNotes(): ?string;

    /**
     * @param string|null $notes
     */
    public function setNotes(?string $notes): void;

    /**
     * @return Collection|OrderItemInterface[]
     */
    public function getItems(): Collection;

    public function clearItems(): void;

    /**
     * @return int
     */
    public function countItems(): int;

    /**
     * @param OrderItemInterface $item
     */
    public function addItem(OrderItemInterface $item): void;

    /**
     * @param OrderItemInterface $item
     */
    public function removeItem(OrderItemInterface $item): void;

    /**
     * @param OrderItemInterface $item
     *
     * @return bool
     */
    public function hasItem(OrderItemInterface $item): bool;

    /**
     * @return int
     */
    public function getItemsTotal(): int;

    public function recalculateItemsTotal(): void;

    /**
     * @return float
     */
    public function getTotal(): float;

    /**
     * @return string
     */
    public function getState(): string;

    /**
     * @param string $state
     */
    public function setState(string $state): void;
//
//    /**
//     * @return bool
//     */
//    public function isEmpty(): bool;
//
//    /**
//     * @return UserInterface|null
//     */
//    public function getUser(): ?UserInterface;
//
//    /**
//     * @return AddressInterface|null
//     */
//    public function getShippingAddress(): ?AddressInterface;
//
//    /**
//     * @param AddressInterface|null $address
//     */
//    public function setShippingAddress(?AddressInterface $address): void;
//
//    /**
//     * @return AddressInterface|null
//     */
//    public function getBillingAddress(): ?AddressInterface;
//
//    /**
//     * @param AddressInterface|null $address
//     */
//    public function setBillingAddress(?AddressInterface $address): void;
//
//    /**
//     * @return string|null
//     */
//    public function getCheckoutState(): ?string;
//
//    /**
//     * @param string|null $checkoutState
//     */
//    public function setCheckoutState(?string $checkoutState): void;
//
//    /**
//     * @return string|null
//     */
//    public function getPaymentState(): ?string;
//
//    /**
//     * @param string|null $paymentState
//     */
//    public function setPaymentState(?string $paymentState): void;
//
//    /**
//     * @return string|null
//     */
//    public function getShippingState(): ?string;
//
//    /**
//     * @param string|null $state
//     */
//    public function setShippingState(?string $state): void;
//
//    /**
//     * @param string|null $state
//     *
//     * @return PaymentInterface|null
//     */
//    public function getLastPayment(?string $state = null): ?PaymentInterface;
//
//    /**
//     * @return int
//     */
//    public function getShippingTotal(): int;
//
//    /**
//     * @return string|null
//     */
//    public function getCustomerIp(): ?string;
//
//    /**
//     * @param string|null $customerIp
//     */
//    public function setCustomerIp(?string $customerIp): void;
}
