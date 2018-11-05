<?php
/** */
namespace App\Entity\Shop;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CategoryImage
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_category_image")
 */
class CategoryImage extends Image
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
     * @var null|Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop\Category", inversedBy="images")
     */
    protected $category;
}
