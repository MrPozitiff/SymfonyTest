<?php
/** */
namespace App\Entity\Shop;

use App\Entity\Traits\DescriptiveTranslationTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translation;

/**
 * Class OptionTranslation
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_option_translation")
 */
class OptionTranslation
{
    use DescriptiveTranslationTrait,
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
