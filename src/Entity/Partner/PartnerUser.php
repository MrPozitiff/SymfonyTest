<?php
/** */
namespace App\Entity\Partner;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PartnerUser
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner_user")
 */
class PartnerUser
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

}
