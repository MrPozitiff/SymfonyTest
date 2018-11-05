<?php

namespace App\Entity\Shop;

use App\Component\Model\CategoryInterface;
use App\Component\Model\ImageInterface;
use App\Component\Model\ProductInterface;
use App\Entity\Partner\PartnerAddress;
use App\Entity\Traits\MetaTranslatableMethodsTrait;
use App\Entity\Traits\NameDescriptionTranslatableMethodsTrait;
use App\Entity\Traits\SluggableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;
use KunicMarko\SonataAnnotationBundle\Annotation as Admin;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Shop\ProductRepository")
 * @ORM\Table(name="app_shop_product")
 *
 * @Admin\Admin("Product")
 */
class Product implements ProductInterface
{
    use TimestampableTrait,
        ToggleableTrait,
        SluggableTrait,
        NameDescriptionTranslatableMethodsTrait,
        MetaTranslatableMethodsTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
        getTranslation as private doGetTranslation;
    }

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
     * @ORM\OneToMany(targetEntity="App\Entity\Shop\ProductImage", mappedBy="product")
     */
    protected $images;

    /**
     * @var null|PartnerAddress
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner\PartnerAddress")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $address;

    /**  */
    public function __construct()
    {
        $this->initializeTranslationsCollection();

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

    /**
     * @param string|null $locale
     *
     * @return ProductTranslation
     */
    public function getTranslation(?string $locale = null): TranslationInterface
    {
        /** @var ProductTranslation $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    /**
     * @return TranslationInterface
     */
    protected function createTranslation(): TranslationInterface
    {
        return new ProductTranslation();
    }
}
