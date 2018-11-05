<?php

namespace App\Entity\Client;

use App\Component\Model\AddressInterface;
use App\Component\Model\CustomerInterface;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\TimestampableTrait;

/**
 * Class Address
 *
 * @ORM\Entity(repositoryClass="")
 * @ORM\Table(name="app_client_customer_address")
 */
class Address implements AddressInterface
{
    use TimestampableTrait;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string|null
     *
     *
     */
    protected $provinceName;

    /**
     * @var string|null
     */
    protected $street;

    /**
     * @var string|null
     */
    protected $city;

    /**
     * @var string|null
     */
    protected $postcode;

    /**
     * @var CustomerInterface
     */
    protected $customer;

    /**
     * Address constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getProvinceName(): ?string
    {
        return $this->provinceName;
    }

    /**
     * {@inheritdoc}
     */
    public function setProvinceName(?string $provinceName): void
    {
        $this->provinceName = $provinceName;
    }

    /**
     * {@inheritdoc}
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * {@inheritdoc}
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    /**
     * {@inheritdoc}
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * {@inheritdoc}
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * {@inheritdoc}
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * {@inheritdoc}
     */
    public function setPostcode(?string $postcode): void
    {
        $this->postcode = $postcode;
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomer(): CustomerInterface
    {
        return $this->customer;
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomer(CustomerInterface $customer): void
    {
        $this->customer = $customer;
    }
}
