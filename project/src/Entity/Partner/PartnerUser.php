<?php
/** */
namespace App\Entity\Partner;

use Doctrine\ORM\Mapping as ORM;
use KunicMarko\SonataAnnotationBundle\Annotation\Admin;
use Sylius\Component\User\Model\User;

/**
 * Class PartnerUser
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner_user")
 *
 * @Admin(
 *     icon="<i class='fa fa-user'></i>",
 *     group="Partner",
 *     label="Partner User",
 *     admin="App\Admin\Partner\PartnerUserAdmin"
 * )
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
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstName;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true, length=16)
     */
    private $phone;

    public function __construct()
    {
        parent::__construct();
        $this->roles = ['ROLE_PARTNER'];
    }

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

    /**
     * @return null|string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param null|string $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param null|string $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return null|string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param null|string $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }
}
