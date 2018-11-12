<?php
/** */
namespace App\Entity\Shop;

use App\Component\Model\CategoryInterface;
use App\Component\Model\ImageInterface;
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

/**
 * Class Category
 *
 * @ORM\Entity(repositoryClass="App\Repository\Shop\CategoryRepository")
 * @ORM\Table(name="app_shop_category")
 * @ORM\HasLifecycleCallbacks()
 *
 * @method CategoryTranslation translate($locale = null, $fallbackToDefault = true)
 */
class Category implements CategoryInterface
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
    private $id;

    /**
     * @var CategoryInterface|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop\Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", nullable=true)
     */
    protected $parent;

    /**
     * @var Collection|CategoryInterface[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Shop\Category", mappedBy="parent")
     */
    protected $children;

    /**
     * @var null|int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var ArrayCollection|CategoryImage[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Shop\CategoryImage", mappedBy="owner", cascade={"persist"})
     */
    private $images;

    /**
     * @var ArrayCollection|Product[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Shop\Product", mappedBy="category")
     */
    private $products;

    /**
     * @var CategoryStatistics
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Shop\CategoryStatistics",
     *     inversedBy="category",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EAGER"
     * )
     */
    private $statistics;

    /**
     * @var Collection|ProductTranslation[]
     */
    protected $translations;

    /**  */
    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->children = new ArrayCollection();
        $this->statistics = new CategoryStatistics($this);
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): ?CategoryInterface
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(?CategoryInterface $parent): void
    {
        $this->parent = $parent;
        if (null !== $parent) {
            $parent->addChild($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function hasChild(CategoryInterface $category): bool
    {
        return $this->children->contains($category);
    }

    /**
     * {@inheritdoc}
     */
    public function hasChildren(): bool
    {
        return !$this->children->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function addChild(CategoryInterface $category): void
    {
        if (!$this->hasChild($category)) {
            $this->children->add($category);
        }

        if ($this !== $category->getParent()) {
            $category->setParent($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeChild(CategoryInterface $category): void
    {
        if ($this->hasChild($category)) {
            $category->setParent(null);

            $this->children->removeElement($category);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAncestors(): Collection
    {
        $ancestors = [];

        for ($ancestor = $this->getParent(); null !== $ancestor; $ancestor = $ancestor->getParent()) {
            $ancestors[] = $ancestor;
        }

        return new ArrayCollection($ancestors);
    }

    /**
     * @inheritDoc
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function setPosition(?int $position): void
    {
        $this->position = $position;
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
     * @return Product[]|ArrayCollection
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * @param Product[]|ArrayCollection $products
     */
    public function setProducts($products): void
    {
        $this->products = $products;
    }

    /**
     * @return CategoryStatistics
     */
    public function getStatistics(): CategoryStatistics
    {
        if (null === $this->statistics) {
            $this->statistics = new CategoryStatistics($this);
        }

        return $this->statistics;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getName();
    }
}
