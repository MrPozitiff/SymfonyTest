<?php
/** */
namespace App\Entity\Partner;

use App\Entity\Address\Address;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translation;

/**
 * Class PartnerAddressTranslation
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner_address_translation")
 */
class PartnerAddressTranslation extends Address
{
    use Translation;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    public $cityArea;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $office;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $metroStation;

    /**
     * @return null|string
     */
    public function getCityArea(): ?string
    {
        return $this->cityArea;
    }

    /**
     * @param null|string $cityArea
     */
    public function setCityArea(?string $cityArea): void
    {
        $this->cityArea = $cityArea;
    }

    /**
     * @return null|string
     */
    public function getOffice(): ?string
    {
        return $this->office;
    }

    /**
     * @param null|string $office
     */
    public function setOffice(?string $office): void
    {
        $this->office = $office;
    }

    /**
     * @return null|string
     */
    public function getMetroStation(): ?string
    {
        return $this->metroStation;
    }

    /**
     * @param null|string $metroStation
     */
    public function setMetroStation(?string $metroStation): void
    {
        $this->metroStation = $metroStation;
    }
}
