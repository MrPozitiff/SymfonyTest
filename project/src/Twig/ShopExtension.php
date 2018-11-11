<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Twig;

use Symfony\Component\Intl\Intl;
use Symfony\Component\Intl\ResourceBundle\LocaleBundleInterface;
use Webmozart\Assert\Assert;

/**
 * Class ShopExtension
 */
class ShopExtension extends \Twig_Extension
{
    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('shop_get_static_pages', [$this, 'getStaticPages'], ['is_safe' => ['html'], 'needs_environment' => true]),
            new \Twig_SimpleFunction('shop_get_locale_switcher', [$this, 'getLocaleSwitcher'], ['is_safe' => ['html'], 'needs_environment' => true])
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
            'locales' => ['en', 'zh'],
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
}
