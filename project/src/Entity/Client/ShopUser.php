<?php

namespace App\Entity\Client;

use App\Component\Model\ShopUserInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Component\Model\CustomerInterface;
use Sylius\Component\Resource\Exception\UnexpectedTypeException;
use Sylius\Component\User\Model\User as BaseUser;

/**
 * Class ShopUser
 *
 * @ORM\Entity(repositoryClass="App\Repository\Client\UserRepository")
 * @ORM\Table(name="app_shop_shop_user")
 */
class ShopUser extends BaseUser implements ShopUserInterface
{
    /**
     * @var CustomerInterface|null
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Client\Customer", mappedBy="user")
     */
    protected $customer;

    /**
     * {@inheritdoc}
     */
    public function getCustomer(): ?CustomerInterface
    {
        return $this->customer;
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomer(?CustomerInterface $customer): void
    {
        if ($this->customer === $customer) {
            return;
        }

        $previousCustomer = $this->customer;
        $this->customer = $customer;

        if ($previousCustomer instanceof CustomerInterface) {
            $previousCustomer->setUser(null);
        }

        if ($customer instanceof CustomerInterface) {
            $customer->setUser($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(): ?string
    {
        if (null === $this->customer) {
            return null;
        }

        return $this->customer->getEmail();
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail(?string $email): void
    {
        if (null === $this->customer) {
            throw new UnexpectedTypeException($this->customer, CustomerInterface::class);
        }

        $this->customer->setEmail($email);
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailCanonical(): ?string
    {
        if (null === $this->customer) {
            return null;
        }

        return $this->customer->getEmailCanonical();
    }

    /**
     * {@inheritdoc}
     */
    public function setEmailCanonical(?string $emailCanonical): void
    {
        if (null === $this->customer) {
            throw new UnexpectedTypeException($this->customer, CustomerInterface::class);
        }

        $this->customer->setEmailCanonical($emailCanonical);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $names = [];
        if (null !== $this->customer) {
            if ($this->customer->getFirstName()) {
                $names[] = $this->customer->getFirstName();
            }
            if ($this->customer->getLastName()) {
                $names[] = $this->customer->getLastName();
            }
        }
        if ($names) {
            return implode(' ', $names);
        } elseif ($this->getUsername()) {
            return (string) $this->getUsername();
        } else {
            return (string) $this->getEmail();
        }
    }
}
