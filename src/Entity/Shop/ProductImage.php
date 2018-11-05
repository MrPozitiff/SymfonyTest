<?php
/** */
namespace App\Entity\Shop;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ProductImage
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_product_image")
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
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop\Product", inversedBy="images")
     */
    protected $product;
}
