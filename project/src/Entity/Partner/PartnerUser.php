<?php
/** */
namespace App\Entity\Partner;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\User\Model\User;

/**
 * Class PartnerUser
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner_user")
 */
class PartnerUser extends User
{
    /**
     * @var Partner
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner\Partner")
     */
    private $partner;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
}
