<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Routing;

use App\Component\Model\CategoryInterface;
use App\Component\Model\ProductInterface;
use App\Component\Repository\CategoryRepositoryInterface;
use App\Repository\Shop\ProductRepository;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class ShopLoader
 */
class CatalogLoader implements LoaderInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var bool
     */
    private $loaded = false;

    /**
     * ShopLoader constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository, ProductRepository $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritDoc
     */
    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "extra" loader twice');
        }

        $routes = new RouteCollection();

        $result = $this->categoryRepository->findRootNodes();

        foreach ($result as $category) {
            $this->registerRoutes($routes, $category->getChildren());
        }

        //mark as loaded
        $this->loaded = true;

        return $routes;

    }

    /**
     * @inheritDoc
     */
    public function supports($resource, $type = null)
    {
        return $type === 'catalog';
    }

    /**
     * @inheritDoc
     */
    public function getResolver()
    {
    }

    /**
     * @inheritDoc
     */
    public function setResolver(LoaderResolverInterface $resolver)
    {
    }

    /**
     * @param RouteCollection     $routes
     * @param CategoryInterface[] $categories
     */
    private function registerRoutes(RouteCollection $routes, $categories): void
    {
        foreach ($categories as $category) {
            $this->addCategoryRoute($routes, $category);
            if ($category->getProducts()->count() > 0) {
                foreach ($category->getProducts() as $product) {
                    $this->addProductRoute($routes, $product);
                }
            }
            if ($category->getChildren()->count() > 0) {
                $this->registerRoutes($routes, $category->getChildren());
            }
        }
    }

    private function addCategoryRoute(RouteCollection $routes, CategoryInterface $category)
    {
        $defaults = [
            '_controller' => 'app.controller.category:indexAction',
            'category'    => $category->getId(),
            '_sylius' => [
                'template' => "Shop/Category/index.html.twig",
                'repository' => [
                    'method' => 'findChildrenById',
                    'arguments' => [$category->getId()],
                ],
                'paginate' => 9,
            ],
        ];
        if ($category->getProducts()->count() > 0) {
            $defaults = [
                '_controller' => 'app.controller.product:indexAction',
                'category'    => $category->getId(),
                '_sylius' => [
                    'template' => "Shop/Product/index.html.twig",
                    'repository' => [
                        'method' => 'findByCategoryId',
                        'arguments' => [$category->getId()],
                    ],
                    'paginate' => 9,
                ],
            ];
        }

        $route = new Route($category->getUrl(), $defaults);
        $routes->add('shop_category_'.$category->getId(), $route);
    }

    private function addProductRoute(RouteCollection $routes, ProductInterface $product)
    {
        $defaults = [
            '_controller' => 'app.controller.product:showAction',
            'product'    => $product->getId(),
            '_sylius' => [
                'template' => "Shop/Product/show.html.twig",
                'criteria' => [
                    'id' => $product->getId(),
                    'enabled' => true,
                ],
                'paginate' => 3,
            ],
        ];

        $route = new Route($product->getUrl(), $defaults);
        $routes->add('shop_product_'.$product->getId(), $route);
    }
}
