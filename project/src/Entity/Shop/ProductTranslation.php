<?php
/** */
namespace App\Entity\Shop;

use App\Entity\Traits\MetaTranslationTrait;
use App\Entity\Traits\DescriptiveTranslationTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translation;

/**
 * Class ProductTranslation
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_product_translation")
 */
class ProductTranslation
{
    use MetaTranslationTrait,
        DescriptiveTranslationTrait,
        Translation;

    /**
     * @var null|int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
}
