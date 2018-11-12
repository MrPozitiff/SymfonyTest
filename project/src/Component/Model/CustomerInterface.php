<?php

namespace App\Component\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\User\Model\UserAwareInterface;
use Sylius\Component\User\Model\UserInterface;

interface CustomerInterface extends UserAwareInterface, ResourceInterface
{
    /**
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void;

    /**
     * Gets normalized email (should be used in search and sort queries).
     *
     * @return string|null
     */
    public function getEmailCanonical(): ?string;

    /**
     * @param string|null $emailCanonical
     */
    public function setEmailCanonical(?string $emailCanonical): void;

    /**
     * @return string
     */
    public function getFullName(): string;

    /**
     * @return string|null
     */
    public function getFirstName(): ?string;

    /**
     * @param string|null $firstName
     */
    public function setFirstName(?string $firstName): void;

    /**
     * @return string|null
     */
    public function getLastName(): ?string;

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void;

    /**
     * @return \DateTimeInterface|null
     */
    public function getBirthday(): ?\DateTimeInterface;

    /**
     * @param \DateTimeInterface|null $birthday
     */
    public function setBirthday(?\DateTimeInterface $birthday): void;

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string;

    /**
     * @param string|null $phoneNumber
     */
    public function setPhoneNumber(?string $phoneNumber): void;

    /**
     * @return bool
     */
    public function isSubscribedToNewsletter(): bool;

    /**
     * @param bool $subscribedToNewsletter
     */
    public function setSubscribedToNewsletter(bool $subscribedToNewsletter): void;

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
