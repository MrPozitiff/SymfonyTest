<?php
/** */
namespace App\Entity\Shop;

use App\Entity\Traits\NameDescriptionTranslationTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Class OptionTranslation
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_option_translation")
 */
class OptionTranslation extends AbstractTranslation implements ResourceInterface
{
    use NameDescriptionTranslationTrait;

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
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
