<?php
/** */
namespace App\Entity\Shop;

use App\Entity\Traits\MetaTranslationTrait;
use App\Entity\Traits\DescriptiveTranslationTrait;
use Knp\DoctrineBehaviors\Model\Translatable\Translation;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CategoryTranslation
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_category_translation")
 */
class CategoryTranslation
{
    use MetaTranslationTrait,
        DescriptiveTranslationTrait,
        Translation;

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;
}
