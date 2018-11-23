<?php
/** */
namespace App\Entity\Partner;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use KunicMarko\SonataAnnotationBundle\Annotation\Admin;

/**
 * Class Address
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner_address")
 *
 *
 * @Admin(
 *     icon="<i class='fa fa-user'></i>",
 *     group="Shop",
 *     label="Product Address",
 *     admin="App\Admin\Partner\PartnerAddressAdmin"
 * )
 *
 * @method null|string getProvince()
 * @method null|string getCity()
 * @method null|string getCityArea()
 * @method null|string getStreet()
 * @method null|string getHouse()
 * @method null|string getOffice()
 */
class PartnerAddress
{
    use Translatable;

    /**
     * @var null|int
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $postcode;

    /**
     * @var Collection|PartnerAddressTranslation[]
     */
    protected $translations;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * @param null|string $postcode
     */
    public function setPostcode(?string $postcode): void
    {
        $this->postcode = $postcode;
    }

    /**
     * @param string $method
     * @param mixed  $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }

    /**
     * @return string
     */
    public function __toString(): ?string
    {
        $address[] = $this->getOffice();
        $address[] = $this->getHouse();
        $address[] = $this->getStreet();
        $address[] = $this->getCityArea();
        $address[] = $this->getCity();
        $address[] = $this->getProvince();
        $address[] = $this->postcode;

        return implode(', ', array_filter($address));
    }
}
