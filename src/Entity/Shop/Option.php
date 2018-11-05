<?php
/** */
namespace App\Entity\Shop;

use App\Component\Model\OptionInterface;
use App\Entity\Traits\NameDescriptionTranslatableMethodsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

/**
 * Class Option
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_option")
 */
class Option implements OptionInterface
{
    use ToggleableTrait,
        TimestampableTrait,
        NameDescriptionTranslatableMethodsTrait;
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
    protected $id;

    /**
     * @var Collection|Product
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Shop\Product", mappedBy="options")
     */
    protected $products;

    /**  */
    public function __construct()
    {
        $this->initializeTranslationsCollection();

        $this->products = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
