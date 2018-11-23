<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Component\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;

/**
 * Interface PartnerInterface
 */
interface PartnerInterface extends
    ResourceInterface,
    ToggleableInterface,
    TimestampableInterface,
    DescriptiveInterface,
    ImagesAwareInterface
{
    /**
     * @return ProductInterface[]|Collection
     */
    public function getProducts(): Collection;

    /**
     * @return PartnerAddressInterface[]|Collection
     */
    public function getAddresses(): Collection;

    /**
     * @param PartnerAddressInterface $address
     */
    public function addAddress(PartnerAddressInterface $address): void;

    /**
     * @param PartnerAddressInterface $address
     */
    public function removeAddress(PartnerAddressInterface $address): void;
}
