<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Entity\Partner;

use App\Entity\Traits\DescriptiveTranslationTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translation;

/**
 * Class PartnerTranslation
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner_translation")
 */
class PartnerTranslation
{
    use Translation,
        DescriptiveTranslationTrait;
}
