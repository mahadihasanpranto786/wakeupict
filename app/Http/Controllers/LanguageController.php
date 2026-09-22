<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch current application locale.
     *
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLanguage($locale)
    {
        if (in_array($locale, ['en', 'bn'])) {
            Session::put('locale', $locale);
            Session::put('manual_locale', true);
            App::setLocale($locale);
            return redirect()->back()
                ->withCookie(cookie()->forever('locale', $locale))
                ->withCookie(cookie()->forever('manual_locale', '1'));
        }

        return redirect()->back();
    }
}
