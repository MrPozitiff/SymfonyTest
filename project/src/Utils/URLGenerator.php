<?php
/** */
namespace App\Utils;

use App\Component\Model\CategoryInterface;
use App\Component\Model\ProductInterface;
use Behat\Transliterator\Transliterator;
use Webmozart\Assert\Assert;

/**
 * Class SlugGenerator
 */
class URLGenerator
{
    /**
     * {@inheritdoc}
     */
    public function generateForCategory(CategoryInterface $category, ?string $locale = null): string
    {
        $parent = $category->getParent();
        if (null === $parent) {
            return '';
        }
        $slug = $category->getSlug();
        if ($parent->getSlug() === 'root') {
            return $slug;
        }

        $parent = $category->getParent();
        $parentUrl = $parent->getUrl() ?: $this->generateForCategory($parent, $locale);

        return $parentUrl . '/' . $slug;
    }

    /**
     * @param ProductInterface $product
     * @param null|string $locale
     *
     * @return string
     */
    public function generateForProduct(ProductInterface $product, ?string $locale = null): string
    {
        $slug = $product->getSlug();
        $category = $product->getCategory();
        if (null === $category) {
            return $slug;
        }

        $categoryUrl = $category->getUrl() ?: $this->generateForCategory($category, $locale);
        return $categoryUrl . '/' . $slug;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function transliterate(string $string): string
    {
        return Transliterator::transliterate(str_replace('/[^\d\w\-\_]/giu', '-', $string));
    }
}
