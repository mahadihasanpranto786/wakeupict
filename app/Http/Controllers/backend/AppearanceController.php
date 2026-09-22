<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\AppearanceSetting;
use Illuminate\Support\Facades\Cache;

class AppearanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Helper to convert HEX color to RGB string (e.g. #10b981 -> "16, 185, 129").
     */
    private function hexToRgb($hex)
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) == 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        if (strlen($hex) != 6) {
            return '16, 185, 129';
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return "$r, $g, $b";
    }

    /**
     * Display Theme Customizer.
     */
    public function theme()
    {
        $primaryColor = AppearanceSetting::getVal('theme_primary_color', '#10b981');
        $accentColor = AppearanceSetting::getVal('theme_accent_color', '#34d399');
        $cyanColor = AppearanceSetting::getVal('theme_cyan_color', '#22d3ee');
        $indigoColor = AppearanceSetting::getVal('theme_indigo_color', '#6366f1');

        return view('backend.theme.clasic.appearance.theme', compact(
            'primaryColor',
            'accentColor',
            'cyanColor',
            'indigoColor'
        ));
    }

    /**
     * Update Theme Colors.
     */
    public function updateTheme(Request $request)
    {
        $request->validate([
            'theme_primary_color' => 'required|string',
            'theme_accent_color' => 'required|string',
        ]);

        $primary = $request->theme_primary_color;
        $accent = $request->theme_accent_color;
        $cyan = $request->theme_cyan_color ?: '#22d3ee';
        $indigo = $request->theme_indigo_color ?: '#6366f1';

        AppearanceSetting::setVal('theme_primary_color', $primary, $primary, 'theme');
        AppearanceSetting::setVal('theme_primary_rgb', $this->hexToRgb($primary), $this->hexToRgb($primary), 'theme');

        AppearanceSetting::setVal('theme_accent_color', $accent, $accent, 'theme');
        AppearanceSetting::setVal('theme_accent_rgb', $this->hexToRgb($accent), $this->hexToRgb($accent), 'theme');

        AppearanceSetting::setVal('theme_cyan_color', $cyan, $cyan, 'theme');
        AppearanceSetting::setVal('theme_indigo_color', $indigo, $indigo, 'theme');

        Cache::forget('appearance_settings_all');

        return redirect()->back()->with('success', 'Theme colors updated successfully! All pages will reflect the new palette.');
    }

    /**
     * Global Settings (Brand, Info, Social, Footer).
     */
    public function globalSettings()
    {
        return view('backend.theme.clasic.appearance.global');
    }

    /**
     * Update Global Settings.
     */
    public function updateGlobal(Request $request)
    {
        $fields = $request->except(['_token', 'logo', 'favicon']);

        // Auto-exchange short-lived token to Never-Expiring Page Token if App ID & Secret are provided
        $exchangeMessage = '';
        if (!empty($request->facebook_app_id) && !empty($request->facebook_app_secret) && !empty($request->facebook_access_token)) {
            $exchanged = $this->exchangeForPermanentPageToken(
                $request->facebook_app_id,
                $request->facebook_app_secret,
                $request->facebook_access_token,
                $request->facebook_page_id ?: '854068321357052'
            );

            if ($exchanged['success']) {
                $fields['facebook_access_token'] = $exchanged['token'];
                $exchangeMessage = ' ' . $exchanged['message'];
            }
        }

        foreach ($fields as $key => $values) {
            if (is_array($values)) {
                $en = isset($values['en']) ? $values['en'] : null;
                $bn = isset($values['bn']) ? $values['bn'] : null;
                AppearanceSetting::setVal($key, $en, $bn, 'global');
            } else {
                AppearanceSetting::setVal($key, $values, $values, 'global');
            }
        }

        Cache::forget('appearance_settings_all');

        return redirect()->back()->with('success', 'Global branding and contact information updated successfully.' . $exchangeMessage);
    }

    /**
     * Exchange short-lived token for a never-expiring Page Access Token.
     */
    private function exchangeForPermanentPageToken($appId, $appSecret, $token, $pageId)
    {
        try {
            // Step 1: Exchange for long-lived user access token (valid 60 days)
            $step1Url = "https://graph.facebook.com/v19.0/oauth/access_token?" . http_build_query([
                'grant_type' => 'fb_exchange_token',
                'client_id' => trim($appId),
                'client_secret' => trim($appSecret),
                'fb_exchange_token' => trim($token),
            ]);

            $ch = curl_init($step1Url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 12,
                CURLOPT_SSL_VERIFYPEER => false,
            ]);
            $res1 = curl_exec($ch);
            curl_close($ch);

            $data1 = json_decode($res1, true);
            if (empty($data1['access_token'])) {
                $errMsg = $data1['error']['message'] ?? 'Unable to exchange token with Meta.';
                return ['success' => false, 'message' => 'Token exchange note: ' . $errMsg];
            }

            $longLivedUserToken = $data1['access_token'];

            // Step 2: Query Graph API for the Page Access Token using the long-lived token
            // A Page Access Token derived from a long-lived user token NEVER EXPIRES.
            $step2Url = "https://graph.facebook.com/v19.0/{$pageId}?fields=access_token&access_token={$longLivedUserToken}";

            $ch2 = curl_init($step2Url);
            curl_setopt_array($ch2, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 12,
                CURLOPT_SSL_VERIFYPEER => false,
            ]);
            $res2 = curl_exec($ch2);
            curl_close($ch2);

            $data2 = json_decode($res2, true);
            if (!empty($data2['access_token'])) {
                return [
                    'success' => true,
                    'token' => $data2['access_token'],
                    'message' => 'Successfully converted to a Permanent (Never-Expiring) Page Access Token!'
                ];
            }

            return [
                'success' => true,
                'token' => $longLivedUserToken,
                'message' => 'Converted to a Long-Lived Token (valid 60 days).'
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Exchange error: ' . $e->getMessage()];
        }
    }

    /**
     * Home Page Appearance & Content.
     */
    public function home()
    {
        return view('backend.theme.clasic.appearance.home');
    }

    /**
     * Update Home Page Texts.
     */
    public function updateHome(Request $request)
    {
        $fields = $request->except(['_token']);

        foreach ($fields as $key => $values) {
            if (is_array($values)) {
                $en = isset($values['en']) ? $values['en'] : null;
                $bn = isset($values['bn']) ? $values['bn'] : null;
                AppearanceSetting::setVal($key, $en, $bn, 'home');
            } else {
                AppearanceSetting::setVal($key, $values, $values, 'home');
            }
        }

        Cache::forget('appearance_settings_all');

        return redirect()->back()->with('success', 'Home page sections and content updated successfully.');
    }

    /**
     * Sections & Static Page Headers.
     */
    public function sections()
    {
        return view('backend.theme.clasic.appearance.sections');
    }

    /**
     * Update Sections & Static Headers.
     */
    public function updateSections(Request $request)
    {
        $fields = $request->except(['_token']);

        foreach ($fields as $key => $values) {
            if (is_array($values)) {
                $en = isset($values['en']) ? $values['en'] : null;
                $bn = isset($values['bn']) ? $values['bn'] : null;
                AppearanceSetting::setVal($key, $en, $bn, 'sections');
            } else {
                AppearanceSetting::setVal($key, $values, $values, 'sections');
            }
        }

        Cache::forget('appearance_settings_all');

        return redirect()->back()->with('success', 'Section headers and page copy updated successfully.');
    }
}
