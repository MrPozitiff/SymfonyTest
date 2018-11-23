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
        $template = $options['template'] ?? 'Shop/Security/Client/auth.html.twig';
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
        } elseif (preg_match('/^shop_category_\d+/', $route)) {
            $category = $this->get('app.repository.category')->find($request->attributes->get('category'));
            $this->categoryBreadcrumbs($category, $breadcrumbs, $request->get('_locale'));
        } elseif (preg_match('/^shop_product_\d+/', $route)) {
            $product = $this->get('app.repository.product')->find($request->attributes->get('product'));
            $this->categoryBreadcrumbs($product->getCategory(), $breadcrumbs, $request->get('_locale'));
            $breadcrumbs[] = [
                'title' => $product->getName(),
                'url' => $this->generateUrl(sprintf('shop_product_%d', $product->getId())),
            ];
        }

        return $this->render('Shop\Fragment\_breadcrumbs.html.twig', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * @param CategoryInterface $category
     * @param array $breadcrumbs
     * @param string $locale
     */
    private function categoryBreadcrumbs(CategoryInterface $category, array &$breadcrumbs, string $locale): void
    {
        $anc = $category->getAncestors();
        if ($anc->count() > 1) {
            /** @var CategoryInterface $category */
            foreach (array_reverse($anc->toArray()) as $category) {
                if ('root' === $category->getSlug()) {
                    continue;
                }
                $breadcrumbs[] = [
                    'title' => $category->getName(),
                    'url' => $this->generateUrl(sprintf('shop_category_%d', $category->getId())),
                ];
            }
        }
    }
}
