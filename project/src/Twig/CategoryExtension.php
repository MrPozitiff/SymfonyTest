<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Twig;

use App\Component\Model\CategoryInterface;
use App\Component\Repository\CategoryRepositoryInterface;

/**
 * Class CategoryExtension
 */
class CategoryExtension extends \Twig_Extension
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * CategoryExtension constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('shop_get_category_by_url', [$this, 'getCategoryByUrl']),
        ];
    }

    /**
     * @param string $url
     *
     * @return CategoryInterface|null
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCategoryByUrl(string $url): ?CategoryInterface
    {
        return $this->categoryRepository->findOneByUrl($url);
    }
}
