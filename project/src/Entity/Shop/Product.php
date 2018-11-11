<?php

namespace App\Entity\Shop;

use App\Component\Model\CategoryInterface;
use App\Component\Model\ImageInterface;
use App\Component\Model\ProductInterface;
use App\Entity\Partner\Partner;
use App\Entity\Partner\PartnerAddress;
use App\Entity\Traits\MetaTranslatableMethodsTrait;
use App\Entity\Traits\NameDescriptionTranslatableMethodsTrait;
use App\Entity\Traits\SluggableTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use Sylius\Component\Resource\Model\ToggleableTrait;
use KunicMarko\SonataAnnotationBundle\Annotation as Admin;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Shop\ProductRepository")
 * @ORM\Table(name="app_shop_product")
 * @ORM\HasLifecycleCallbacks()
 *
 * @Admin\Admin(
 *     icon="<i class='fa fa-user'></i>",
 *     group="Shop",
 *     label="Product"
 * )
 */
class Product implements ProductInterface
{
    use TimestampableTrait,
        ToggleableTrait,
        SluggableTrait,
        NameDescriptionTranslatableMethodsTrait,
        MetaTranslatableMethodsTrait,
        Translatable;

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Admin\ListField()
     */
    protected $id;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     *
     * @Admin\FormField()
     * @Admin\ListField()
     */
    protected $price;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     *
     * @Admin\FormField()
     */
    protected $partnerPrice;

    /**
     * @var null|int
     *
     * @ORM\Column(type="integer")
     *
     * @Admin\FormField()
     */
    protected $storageCount = 0;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     *
     * @Admin\FormField()
     */
    protected $storageLimited = false;

    /**
     * @var Partner
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner\Partner")
     *
     * @Admin\ListAssociationField(field="name")
     */
    private $partner;

    /**
     * @var null|Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop\Category", inversedBy="products")
     *
     * @Admin\FormField()
     * @Admin\ListAssociationField(field="name")
     */
    protected $category;

    /**
     * @var Collection|Option[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Shop\Option", inversedBy="products")
     * @ORM\JoinTable(name="app_shop_product_option")
     *
     * @Admin\FormField()
     */
    protected $options;

    /**
     * @var Collection|ProductImage[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Shop\ProductImage", mappedBy="owner", cascade={"persist"})
     */
    protected $images;

    /**
     * @var null|PartnerAddress
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner\PartnerAddress")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $address;

    /**
     * @var Collection|ProductTranslation[]
     *
     * @Admin\FormField(
     *     type="A2lix\TranslationFormBundle\Form\Type\TranslationsType",
     *     options={
     *          "fields"={
     *              "description"={
     *                  "field_type"="Symfony\Component\Form\Extension\Core\Type\TextareaType"
     *              }
     *          }
     *     }
     * )
     */
    protected $translations;

    /**  */
    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPartnerPrice(): ?float
    {
        return $this->partnerPrice;
    }

    /**
     * @param float $partnerPrice
     */
    public function setPartnerPrice(float $partnerPrice): void
    {
        $this->partnerPrice = $partnerPrice;
    }

    /**
     * @return int|null
     */
    public function getStorageCount(): ?int
    {
        return $this->storageCount;
    }

    /**
     * @param int|null $storageCount
     */
    public function setStorageCount(?int $storageCount): void
    {
        $this->storageCount = $storageCount;
    }

    /**
     * @return bool
     */
    public function isStorageLimited(): bool
    {
        return $this->storageLimited;
    }

    /**
     * @param bool $storageLimited
     */
    public function setStorageLimited(bool $storageLimited): void
    {
        $this->storageLimited = $storageLimited;
    }

    /**
     * @return Partner
     */
    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    /**
     * @param Partner $partner
     */
    public function setPartner(Partner $partner): void
    {
        $this->partner = $partner;
    }

    /**
     * @return CategoryInterface|null
     */
    public function getCategory(): ?CategoryInterface
    {
        return $this->category;
    }

    /**
     * @param CategoryInterface|null $category
     */
    public function setCategory(?CategoryInterface $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Option[]|Collection
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    /**
     * @param Option[]|Collection $options
     */
    public function setOptions($options): void
    {
        $this->options = $options;
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
     * @return PartnerAddress|null
     */
    public function getAddress(): ?PartnerAddress
    {
        return $this->address;
    }

    /**
     * @param PartnerAddress|null $address
     */
    public function setAddress(?PartnerAddress $address): void
    {
        $this->address = $address;
    }
}
