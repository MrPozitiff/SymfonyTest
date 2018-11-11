<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Form\Type\Shop;

use App\Form\Type\ImageType;

/**
 * Class CategoryImage
 */
class CategoryImageType extends ImageType
{
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'app_category_image';
    }
}
