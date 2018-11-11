<?php
/** */
namespace App\Entity\Partner;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use App\Entity\Traits\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;

/**
 * Class Partner
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner")
 * @ORM\HasLifecycleCallbacks()
 */
class Partner implements ResourceInterface, ToggleableInterface, TimestampableInterface
{
    use ToggleableTrait,
        TimestampableTrait;

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

    /**  */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
