<?php

namespace App\Component\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Customer\Model\CustomerInterface as BaseCustomerInterface;
use Sylius\Component\User\Model\UserAwareInterface;
use Sylius\Component\User\Model\UserInterface;

interface CustomerInterface extends BaseCustomerInterface, UserAwareInterface
{
//    /**
//     * @return Collection|OrderInterface[]
//     */
//    public function getOrders(): Collection;

    /**
     * @return AddressInterface|null
     */
    public function getDefaultAddress(): ?AddressInterface;

    /**
     * @param AddressInterface|null $defaultAddress
     */
    public function setDefaultAddress(?AddressInterface $defaultAddress): void;

    /**
     * @param AddressInterface $address
     */
    public function addAddress(AddressInterface $address): void;

    /**
     * @param AddressInterface $address
     */
    public function removeAddress(AddressInterface $address): void;

    /**
     * @param AddressInterface $address
     *
     * @return bool
     */
    public function hasAddress(AddressInterface $address): bool;

    /**
     * @return Collection|AddressInterface[]
     */
    public function getAddresses(): Collection;

    /**
     * @return bool
     */
    public function hasUser(): bool;

    /**
     * @return ShopUserInterface|UserInterface|null
     */
    public function getUser(): ?UserInterface;

    /**
     * @param ShopUserInterface|UserInterface|null $user
     */
    public function setUser(?UserInterface $user);
}
