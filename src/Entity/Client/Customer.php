<?php

namespace App\Entity\Client;

use App\Component\Model\AddressInterface;
use App\Component\Model\CustomerInterface;
use App\Component\Model\ShopUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Customer\Model\Customer as BaseCustomer;
use Sylius\Component\User\Model\UserInterface as BaseUserInterface;
use Webmozart\Assert\Assert;

class Customer extends BaseCustomer implements CustomerInterface
{
//    /**
//     * @var Collection|OrderInterface[]
//     */
//    protected $orders;

    /**
     * @var AddressInterface
     */
    protected $defaultAddress;

    /**
     * @var Collection|AddressInterface[]
     */
    protected $addresses;

    /**
     * @var ShopUserInterface
     */
    protected $user;

    public function __construct()
    {
        parent::__construct();

//        $this->orders = new ArrayCollection();
        $this->addresses = new ArrayCollection();
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function getOrders(): Collection
//    {
//        return $this->orders;
//    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultAddress(): ?AddressInterface
    {
        return $this->defaultAddress;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultAddress(?AddressInterface $defaultAddress): void
    {
        $this->defaultAddress = $defaultAddress;

        if (null !== $defaultAddress) {
            $this->addAddress($defaultAddress);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addAddress(AddressInterface $address): void
    {
        if (!$this->hasAddress($address)) {
            $this->addresses[] = $address;
            $address->setCustomer($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAddress(AddressInterface $address): void
    {
        $this->addresses->removeElement($address);
        $address->setCustomer(null);
    }

    /**
     * {@inheritdoc}
     */
    public function hasAddress(AddressInterface $address): bool
    {
        return $this->addresses->contains($address);
    }

    /**
     * {@inheritdoc}
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): ?BaseUserInterface
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(?BaseUserInterface $user): void
    {
        if ($this->user === $user) {
            return;
        }

        /** @var ShopUserInterface|null $user */
        Assert::nullOrIsInstanceOf($user, ShopUserInterface::class);

        $previousUser = $this->user;
        $this->user = $user;

        if ($previousUser instanceof ShopUserInterface) {
            $previousUser->setCustomer(null);
        }

        if ($user instanceof ShopUserInterface) {
            $user->setCustomer($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasUser(): bool
    {
        return null !== $this->user;
    }
}
