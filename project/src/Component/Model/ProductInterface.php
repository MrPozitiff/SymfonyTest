<?php
/** */
namespace App\Component\Model;

use App\Entity\Partner\Partner;
use App\Entity\Partner\PartnerAddress;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\SlugAwareInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;

/**
 * Interface ProductInterface
 */
interface ProductInterface extends
    SlugGeneratedResourceInterface,
    ToggleableInterface,
    TimestampableInterface,
    MetaInterface,
    ImagesAwareInterface,
    UrlInterface
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
     * @return int
     */
    public function getPurchasedCount(): int;

    /**  */
    public function purchase(): void;

    /**
     * @return null|Partner
     */
    public function getPartner(): ?Partner;

    /**
     * @param Partner $partner
     */
    public function setPartner(Partner $partner): void;

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
