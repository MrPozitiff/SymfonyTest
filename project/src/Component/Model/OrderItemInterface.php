<?php

namespace App\Component\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;

interface OrderItemInterface extends OrderAwareInterface, ResourceInterface
{
    /**
     * @return float
     */
    public function getUnitPrice(): float;

    /**
     * @return float
     */
    public function getTotal(): float;

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface;

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product): void;

    /**
     * @param \DateTime|null $useBefore
     */
    public function setUseBefore(?\DateTime $useBefore): void;

    /**
     * @return float
     */
    public function getItemPrice(): float;

    /**
     * @return Collection|OptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param OptionInterface $option
     */
    public function addOption(OptionInterface $option): void;

    /**
     * @param OptionInterface $option
     */
    public function removeOption(OptionInterface $option): void;

    /**
     * @return null|string
     */
    public function getState(): string;

    /**
     * @param null|string $state
     */
    public function setState(string $state): void;
}
