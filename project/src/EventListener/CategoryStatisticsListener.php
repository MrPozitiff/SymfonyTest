<?php

namespace App\EventListener;

use App\Component\Model\CategoryInterface;
use App\Component\Model\ProductInterface;
use App\Component\Repository\CategoryRepositoryInterface;
use Sonata\AdminBundle\Event\PersistenceEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class ImagesUploadListener
 */
class CategoryStatisticsListener implements EventSubscriberInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            'sonata.admin.event.persistence.post_persist' => 'calculateStatistics',
            'sonata.admin.event.persistence.post_update' => 'calculateStatistics',
        ];
    }

    /**
     * @param PersistenceEvent $event
     */
    public function calculateStatistics(PersistenceEvent $event): void
    {
        $subject = $event->getObject();
        if ($subject instanceof CategoryInterface || $subject instanceof ProductInterface) {
            $root = $this->categoryRepository->findRootNodes();
            foreach ($root as $category) {
                $this->calculateForCategory($category);
            }
        }
    }

    /**
     * @param CategoryInterface $category
     */
    private function calculateForCategory(CategoryInterface $category): void
    {
        if ($category->getChildren()->count() > 0) {
            foreach ($category->getChildren() as $child) {
                $this->calculateForCategory($child);
            }
        }

        $productStats = $this->getProductStats($category);
        $category->getStatistics()
            ->setTotalProductsCount($productStats['count'])
            ->setMaxProductPrice(empty($productStats['count']) ? null : $productStats['max'])
            ->setMinProductPrice(empty($productStats['count']) ? null : $productStats['min']);
        $this->categoryRepository->save($category);
    }

    /**
     * @param CategoryInterface $category
     *
     * @return array
     */
    private function getProductStats(CategoryInterface $category)
    {
        $min = null;
        $max = 0;
        $count = array_reduce(
            $category->getChildren()->toArray(),
            function (int $carry, CategoryInterface $category) use(&$min, &$max) {
                if ($category->isEnabled()) {
                    $catStats = $category->getStatistics();
                    $min = $min ?: $catStats->getMinProductPrice();
                    $min = $min > $catStats->getMinProductPrice() ? $catStats->getMinProductPrice() : $min;
                    $max = $max < $catStats->getMaxProductPrice() ? $catStats->getMaxProductPrice() : $max;
                    $carry += $category->getStatistics()->getTotalProductsCount();
                }

                return $carry;
            }, 0);

        $count += $category->getProducts()->filter(function (ProductInterface $product) use (&$min, &$max) {
                if ($product->isEnabled()) {
                    $min = $min ?: $product->getPrice();
                    $min = $min > $product->getPrice() ? $product->getPrice() : $min;
                    $max = $max < $product->getPrice() ? $product->getPrice() : $max;

                    return true;
                }
                return false;
            })->count();

        return [
            'count' => $count,
            'min' => $min,
            'max' => $max,
        ];
    }
}
