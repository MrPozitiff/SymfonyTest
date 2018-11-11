<?php

namespace App\Component\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface AddressInterface extends ResourceInterface
{
    /**
     * @return string|null
     */
    public function getProvince(): ?string;

    /**
     * @param string|null $provinceName
     */
    public function setProvince(?string $provinceName): void;

    /**
     * @return string|null
     */
    public function getStreet(): ?string;

    /**
     * @param string|null $street
     */
    public function setStreet(?string $street): void;

    /**
     * @return string|null
     */
    public function getCity(): ?string;

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void;

    /**
     * @return string|null
     */
    public function getPostcode(): ?string;

    /**
     * @param string|null $postcode
     */
    public function setPostcode(?string $postcode): void;

    /**
     * @return CustomerInterface
     */
    public function getCustomer(): CustomerInterface;

    /**
     * @param CustomerInterface $customer
     */
    public function setCustomer(CustomerInterface $customer): void;
}
