<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Twig;

use Pagerfanta\Pagerfanta;
use Symfony\Component\Intl\Intl;
use Webmozart\Assert\Assert;

/**
 * Class ShopExtension
 */
class ShopExtension extends \Twig_Extension
{
    private const PAGE_VIEW_RANGE = 3;
    /**
     * @var array
     */
    private $locales;

    /**
     * ShopExtension constructor.
     *
     * @param array $locales
     */
    public function __construct(array $locales)
    {
        $this->locales = $locales;
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('shop_get_static_pages', [$this, 'getStaticPages'], ['is_safe' => ['html'], 'needs_environment' => true]),
            new \Twig_SimpleFunction('shop_get_locale_switcher', [$this, 'getLocaleSwitcher'], ['is_safe' => ['html'], 'needs_environment' => true]),
            new \Twig_SimpleFunction('shop_get_paginator', [$this, 'getPaginator'], ['is_safe' => ['html'], 'needs_environment' => true]),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters(): array
    {
        return [
            new \Twig_Filter('locale_name', [$this, 'getLocaleName']),
        ];
    }

    /**
     * @param \Twig_Environment $environment
     *
     * @return string
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getStaticPages(\Twig_Environment $environment)
    {
        $pages = ['How it works', 'About', 'FAQ', 'Delivery & Payment'];

        return $environment->render('Shop/Fragment/_static_pages.html.twig', [
            'pages' => $pages,
        ]);
    }

    /**
     * @param \Twig_Environment $environment
     * @param string $currentLocale
     *
     * @return string
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getLocaleSwitcher(\Twig_Environment $environment, string $currentLocale)
    {
        return $environment->render('Shop/Fragment/_localeSwitch.html.twig', [
            'active' => $currentLocale,
            'locales' => $this->locales,
        ]);
    }

    /**
     * @param string $locale
     *
     * @return null|string
     */
    public function getLocaleName(string $locale)
    {
        $name = Intl::getLocaleBundle()->getLocaleName($locale, $locale);

        Assert::string($name, sprintf('Cannot find name for "%s" locale code', $locale));

        return $name;
    }

    /**
     * @param \Twig_Environment $e
     * @param Pagerfanta $pagerfanta
     *
     * @param string $urlPath
     *
     * @return string
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getPaginator(\Twig_Environment $e, Pagerfanta $pagerfanta, string $urlPath): string
    {
        $pagesCount = ceil($pagerfanta->getAdapter()->getNbResults() / $pagerfanta->getMaxPerPage());
        if ($pagesCount <= 1) {
            return '';
        }
        $currentPage = $pagerfanta->getCurrentPage();

        $min = ($currentPage - self::PAGE_VIEW_RANGE) < 2 ? 2 : ($currentPage - self::PAGE_VIEW_RANGE);
        $max = ($currentPage + self::PAGE_VIEW_RANGE) >= ($pagesCount - 1) ? ($pagesCount - 1) : ($currentPage + self::PAGE_VIEW_RANGE);

        return $e->render('Shop/Fragment/_paginator.html.twig', [
            'min' => $min,
            'max' => $max,
            'paginator' => $pagerfanta,
            'path' => $urlPath,
            'pagesCount' => $pagesCount,
        ]);
    }
}
