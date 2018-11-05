<?php
/** */
namespace App\Entity\Shop;

use App\Entity\Traits\MetaTranslationTrait;
use App\Entity\Traits\NameDescriptionTranslationTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Class ProductTranslation
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_product_translation")
 */
class ProductTranslation extends AbstractTranslation implements ResourceInterface
{
    use MetaTranslationTrait,
        NameDescriptionTranslationTrait;

    /**
     * @var null|int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @return int|mixed|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
