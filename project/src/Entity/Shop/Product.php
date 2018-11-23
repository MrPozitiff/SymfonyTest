<?php

namespace App\Entity\Shop;

use App\Component\Model\CategoryInterface;
use App\Component\Model\ImageInterface;
use App\Component\Model\ProductInterface;
use App\Entity\Partner\Partner;
use App\Entity\Partner\PartnerAddress;
use App\Entity\Traits\MetaTranslatableMethodsTrait;
use App\Entity\Traits\DescriptiveTranslatableMethodsTrait;
use App\Entity\Traits\SluggableTrait;
use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\UrlTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use App\Entity\Traits\ToggleableTrait;
use KunicMarko\SonataAnnotationBundle\Annotation as Admin;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Shop\ProductRepository")
 * @ORM\Table(name="app_shop_product")
 * @ORM\HasLifecycleCallbacks()
 *
 * @Admin\Admin(
 *     icon="<i class='fa fa-user'></i>",
 *     group="Shop",
 *     label="Product",
 *     admin="App\Admin\Shop\ProductAdmin"
 * )
 */
class Product implements ProductInterface
{
    use TimestampableTrait,
        ToggleableTrait,
        SluggableTrait,
        DescriptiveTranslatableMethodsTrait,
        MetaTranslatableMethodsTrait,
        UrlTrait,
        Translatable;

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $code;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $price;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $partnerPrice;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $purchasedCount = 0;

    /**
     * @var Partner
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner\Partner", inversedBy="products")
     */
    private $partner;

    /**
     * @var null|Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop\Category", inversedBy="products")
     */
    protected $category;

    /**
     * @var Collection|Option[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Shop\Option", inversedBy="products")
     * @ORM\JoinTable(name="app_shop_product_option")
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
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param null|string $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
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
     * @return int
     */
    public function getPurchasedCount(): int
    {
        return $this->purchasedCount;
    }

    /**  */
    public function purchase(): void
    {
        $this->purchasedCount += 1;
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('(%s) %s', $this->code, $this->getName());
    }
}
