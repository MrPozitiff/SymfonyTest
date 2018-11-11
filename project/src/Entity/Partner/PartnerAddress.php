<?php
/** */
namespace App\Entity\Partner;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;

/**
 * Class Address
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner_address")
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

    /*
     * @Admin\FormField(
     *     type="A2lix\TranslationFormBundle\Form\Type\TranslationsType",
     *     options={
     *          "fields"={
     *              "description"={
     *                  "field_type"="Symfony\Component\Form\Extension\Core\Type\TextareaType"
     *              }
     *          }
     *     }
     * )
     */
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
}
