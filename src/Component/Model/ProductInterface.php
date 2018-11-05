<?php
/** */
namespace App\Component\Model;

use App\Entity\Partner\PartnerAddress;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\SlugAwareInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

/**
 * Interface ProductInterface
 */
interface ProductInterface extends
    ResourceInterface,
    SlugAwareInterface,
    ToggleableInterface,
    TimestampableInterface,
    TranslatableInterface,
    MetaInterface,
    ImagesAwareInterface
{
    /**
     * @return null|float
     */
    public function getPrice(): ?float;

    /**
     * @param float $price
     */
    public function setPrice(float $price): void;

    /**
     * @return null|float
     */
    public function getPartnerPrice(): ?float;

    /**
     * @param float $partnerPrice
     */
    public function setPartnerPrice(float $partnerPrice): void;

    /**
     * @return int|null
     */
    public function getStorageCount(): ?int;

    /**
     * @param int|null $storageCount
     */
    public function setStorageCount(?int $storageCount): void;

    /**
     * @return bool
     */
    public function isStorageLimited(): bool;

    /**
     * @param bool $storageLimited
     */
    public function setStorageLimited(bool $storageLimited): void;

    /**
     * @return CategoryInterface|null
     */
    public function getCategory(): ?CategoryInterface;

    /**
     * @param CategoryInterface|null $category
     */
    public function setCategory(?CategoryInterface $category): void;

    /**
     * @return OptionInterface[]|Collection
     */
    public function getOptions(): Collection;

    /**
     * @param OptionInterface[]|Collection $options
     */
    public function setOptions($options): void;

    /**
     * @return PartnerAddress|null
     */
    public function getAddress(): ?PartnerAddress;

    /**
     * @param PartnerAddress|null $address
     */
    public function setAddress(?PartnerAddress $address): void;
}
