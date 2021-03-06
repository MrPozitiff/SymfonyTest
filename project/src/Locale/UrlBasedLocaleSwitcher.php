<?php

namespace App\Locale;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class UrlBasedLocaleSwitcher implements LocaleSwitcherInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Request $request, string $localeCode): RedirectResponse
    {
        return new RedirectResponse($this->urlGenerator->generate('app_shop_homepage', ['_locale' => $localeCode]));
    }
}
