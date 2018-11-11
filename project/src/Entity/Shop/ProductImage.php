<?php
/** */
namespace App\Entity\Shop;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class ProductImage
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_product_image")
 * @ORM\HasLifecycleCallbacks()
 *
 * @Vich\Uploadable()
 */
class ProductImage extends Image
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var null|\SplFileInfo
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="path")
     */
    protected $file;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop\Product", inversedBy="images")
     */
    protected $owner;
}
