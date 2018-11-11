<?php
/** */
namespace App\Entity\Shop;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class CategoryImage
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_category_image")
 * @ORM\HasLifecycleCallbacks()
 *
 * @Vich\Uploadable()
 */
class CategoryImage extends Image
{
    /**
     * @var null|\SplFileInfo
     *
     * @Vich\UploadableField(mapping="category_image", fileNameProperty="path")
     */
    protected $file;

    /**
     * @var null|Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop\Category", inversedBy="images")
     */
    protected $owner;
}
