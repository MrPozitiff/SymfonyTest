<?php
/** */
namespace App\Entity\Partner;

use Sylius\Component\Resource\Model\AbstractTranslation;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Class PartnerAddressTranslation
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner_address_translation")
 */
class PartnerAddressTranslation extends AbstractTranslation implements ResourceInterface
{
    /**
     * @var null|int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


}
