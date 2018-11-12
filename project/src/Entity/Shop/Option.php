<?php
/** */
namespace App\Entity\Shop;

use App\Component\Model\OptionInterface;
use App\Entity\Traits\DescriptiveTranslatableMethodsTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use KunicMarko\SonataAnnotationBundle\Annotation\Admin;
use App\Entity\Traits\ToggleableTrait;

/**
 * Class Option
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_option")
 * @ORM\HasLifecycleCallbacks()
 *
 * @Admin(
 *     label="Product Option",
 *     group="Shop",
 *     admin="App\Admin\Shop\OptionAdmin"
 * )
 */
class Option implements OptionInterface
{
    use ToggleableTrait,
        TimestampableTrait,
        DescriptiveTranslatableMethodsTrait,
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
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $price = 0;

    /**
     * @var Collection|Product
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Shop\Product", mappedBy="options")
     */
    protected $products;

    /**  */
    public function __construct()
    {
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
     * @return Product|Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product|Collection $products
     */
    public function setProducts($products): void
    {
        $this->products = $products;
    }
}
