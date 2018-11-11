<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Entity\Partner;

use App\Entity\Shop\Image;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class PartnerImage
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_partner_partner_image")
 * @ORM\HasLifecycleCallbacks()
 *
 * @Vich\Uploadable()
 */
class PartnerImage extends Image
{
    /**
     * @var null|\SplFileInfo
     *
     * @Vich\UploadableField(mapping="partner_image", fileNameProperty="path")
     */
    protected $file;

    /**
     * @var null|Partner
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner\Partner", inversedBy="images")
     */
    protected $owner;
}
