<?php

namespace App\Locale;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

interface LocaleSwitcherInterface
{
    /**
     * @param Request $request
     * @param string $localeCode
     *
     * @return RedirectResponse
     */
    public function handle(Request $request, string $localeCode): RedirectResponse;
}
