<?php
/** */
namespace App\Entity\Partner;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\ToggleableTrait;

/**
 * Class Partner
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner")
 */
class Partner implements ResourceInterface, ToggleableInterface
{
    use ToggleableTrait;

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
