<?php
/** */
namespace App\Controller\Shop;

use App\Component\Model\CategoryInterface;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

/**
 * Class ShopController
 */
class ShopController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $root = $this->get('app.repository.category')->findRootNodes();

        return $this->render('Shop/main.html.twig', [
            'root' => $root[0],
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function authAction(Request $request)
    {
        $options = $request->attributes->get('_app_options');
        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        return $this->render($template);
    }

    public function generateBreadCrumbs()
    {
        $breadcrumbs[] = [
            'title' => $this->get('translator')->trans('template.breadcrumbs.home'),
            'url' => $this->generateUrl('app_shop_homepage'),
        ];
        $request = $this->get('request_stack')->getMasterRequest();
        if (null === $request) {
            return $this->render('Shop\Fragment\_breadcrumbs.html.twig', [
                'breadcrumbs' => $breadcrumbs,
            ]);
        }
        $route = $request->get('_route');
        if (preg_match('/^app_shop_static_(.)+$/', $route, $matches)) {
            $breadcrumbs[] = [
                'title' => $this->get('translator')->trans(sprintf('template.breadcrumbs.%s', $matches[1])),
                'url' => $this->generateUrl('app_shop_homepage'),
            ];
        } elseif (preg_match('/^app_shop_category_\w+_index/', $route)) {
            $category = $this->get('app.repository.category')->findOneByUrl($request->attributes->get('urlPath'));
            $this->categoryBreadcrumbs($category, $breadcrumbs);
        } elseif ('app_shop_product_view_index' === $route) {
            $product = $this->get('app.repository.product')->findOneByUrl($request->attributes->get('urlPath'));
            $this->categoryBreadcrumbs($product->getCategory(), $breadcrumbs);
            $breadcrumbs[] = [
                'title' => $product->getName(),
                'url' => $this->generateUrl('app_shop_product_view_index', ['urlPath' => $product->getUrl()]),
            ];
        }

        return $this->render('Shop\Fragment\_breadcrumbs.html.twig', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * @param CategoryInterface $category
     * @param array $breadcrumbs
     */
    private function categoryBreadcrumbs(CategoryInterface $category, array &$breadcrumbs): void
    {
        $parent = $category->getParent();
        $firstLevel = $category->getParent()->getSlug() === 'root';
        if (!$firstLevel) {
            $breadcrumbs[] = [
                'title' => $parent->getName(),
                'url' => $this->generateUrl('app_shop_category_level_index', ['urlPath' => $parent->getUrl()]),
            ];
        }
        $route = $firstLevel ? 'app_shop_category_level_index' : 'app_shop_category_products_index';
        $breadcrumbs[] = [
            'title' => $category->getName(),
            'url' => $this->generateUrl($route, ['urlPath' => $category->getUrl()]),
        ];
    }
}
