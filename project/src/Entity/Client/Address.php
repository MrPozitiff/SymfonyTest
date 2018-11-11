<?php

namespace App\Entity\Client;

use App\Component\Model\AddressInterface;
use App\Component\Model\CustomerInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Address\Address as BaseAddress;

/**
 * Class Address
 *
 * @ORM\Entity(repositoryClass="")
 * @ORM\Table(name="app_client_customer_address")
 */
class Address extends BaseAddress implements AddressInterface
{
    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $postcode;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $apartments;

    /**
     * @var CustomerInterface
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Client\Customer", inversedBy="addresses")
     */
    protected $customer;

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

    /**
     * @return null|string
     */
    public function getApartments(): ?string
    {
        return $this->apartments;
    }

    /**
     * @param null|string $apartments
     */
    public function setApartments(?string $apartments): void
    {
        $this->apartments = $apartments;
    }

    /**
     * @return null|string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * @param null|string $postcode
     */
    public function setPostcode(?string $postcode): void
    {
        $this->postcode = $postcode;
    }
}
