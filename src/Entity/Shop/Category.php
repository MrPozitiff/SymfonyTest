<?php
/** */
namespace App\Entity\Shop;

use App\Component\Model\CategoryInterface;
use App\Component\Model\ImageInterface;
use App\Entity\Traits\MetaTranslatableMethodsTrait;
use App\Entity\Traits\NameDescriptionTranslatableMethodsTrait;
use App\Entity\Traits\SluggableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use KunicMarko\SonataAnnotationBundle\Annotation as Admin;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

/**
 * Class Category
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_category")
 *
 * @Admin\Admin(
 *     icon="<i class='fa fa-user'></i>",
 *     group="Category",
 *     label="Category"
 * )
 */
class Category implements CategoryInterface
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
     */
    private $id;

    /**
     * @var ArrayCollection|CategoryImage[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Shop\CategoryImage", mappedBy="category")
     */
    private $images;

    /**
     * @var ArrayCollection|Product[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Shop\Product", mappedBy="category")
     */
    private $products;

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->initializeTranslationsCollection();

        $this->products = new ArrayCollection();
        $this->images = new ArrayCollection();
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
     * @param string|null $locale
     *
     * @return CategoryTranslation
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
