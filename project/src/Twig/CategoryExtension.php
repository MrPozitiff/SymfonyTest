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
            new \Twig_SimpleFunction('shop_get_category', [$this, 'getCategoryByUrl']),
        ];
    }

    /**
     * @param int $id
     *
     * @return CategoryInterface|null
     */
    public function getCategoryByUrl(int $id): ?CategoryInterface
    {
        return $this->categoryRepository->find($id);
    }
}
