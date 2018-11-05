<?php
/** */
namespace App\Entity\Shop;

use App\Entity\Traits\MetaTranslationTrait;
use App\Entity\Traits\NameDescriptionTranslationTrait;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Class CategoryTranslation
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_category_translation")
 */
class CategoryTranslation extends AbstractTranslation implements ResourceInterface
{
    use MetaTranslationTrait,
        NameDescriptionTranslationTrait;

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
