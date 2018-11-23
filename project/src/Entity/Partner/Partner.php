<?php

namespace App\Entity\Partner;

use App\Component\Model\ImageInterface;
use App\Component\Model\PartnerAddressInterface;
use App\Component\Model\PartnerInterface;
use App\Component\Model\ProductInterface;
use App\Entity\Traits\DescriptiveTranslatableMethodsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use KunicMarko\SonataAnnotationBundle\Annotation\Admin;
use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\ToggleableTrait;

/**
 * Class Partner
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner")
 * @ORM\HasLifecycleCallbacks()
 *
 * @Admin(
 *     icon="<i class='fa fa-user'></i>",
 *     group="Partner",
 *     label="Partner",
 *     admin="App\Admin\Partner\PartnerAdmin"
 * )
 */
class Partner implements PartnerInterface
{
    use ToggleableTrait,
        TimestampableTrait,
        Translatable,
        DescriptiveTranslatableMethodsTrait;

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var Collection|PartnerImage
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Partner\PartnerImage", mappedBy="owner")
     */
    private $images;

    /**
     * @var Collection|PartnerAddress[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Partner\PartnerAddress", cascade={"persist"})
     * @ORM\JoinTable(name="app_partner_partner_address_partner",
     *     joinColumns={@ORM\JoinColumn(name="partner_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id")}
     * )
     */
    private $addresses;

    /**
     * @var Collection|ProductInterface[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Shop\Product", mappedBy="partner")
     */
    private $products;

    /**  */
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->addImage(new PartnerImage());
        $this->addresses = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return ImageInterface[]|Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @return bool
     */
    public function hasImages(): bool
    {
        return !$this->images->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function hasImage(ImageInterface $image): bool
    {
        return $this->images->contains($image);
    }

    /**
     * @param ImageInterface $image
     */
    public function addImage(ImageInterface $image): void
    {
        $image->setOwner($this);
        $this->images->add($image);
    }

    /**
     * @param ImageInterface $image
     */
    public function removeImage(ImageInterface $image): void
    {
        if ($this->hasImage($image)) {
            $image->setOwner(null);
            $this->images->removeElement($image);
        }
    }

    /**
     * @return PartnerAddress[]|Collection
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    /**
     * @param PartnerAddressInterface $address
     */
    public function addAddress(PartnerAddressInterface $address): void
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses->add($address);
        }
    }

    /**
     * @param PartnerAddressInterface $address
     */
    public function removeAddress(PartnerAddressInterface $address): void
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
        }
    }

    /**
     * @return ProductInterface[]|Collection
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getName();
    }
}
