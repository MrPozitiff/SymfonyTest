<?php
/** */
namespace App\Entity\Shop;

use App\Component\Model\OptionInterface;
use App\Entity\Traits\NameDescriptionTranslatableMethodsTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use Sylius\Component\Resource\Model\ToggleableTrait;

/**
 * Class Option
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_option")
 * @ORM\HasLifecycleCallbacks()
 */
class Option implements OptionInterface
{
    use ToggleableTrait,
        TimestampableTrait,
        NameDescriptionTranslatableMethodsTrait,
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
}
