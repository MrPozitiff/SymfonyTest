<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Form\Type\Shop;

use App\Form\Type\ImageType;

/**
 * Class ProductImage
 */
class ProductImageType extends ImageType
{
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'app_product_image';
    }
}