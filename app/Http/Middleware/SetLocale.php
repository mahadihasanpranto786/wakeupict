<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class SetLocale
{
    /**
     * Handle an incoming request with intelligent country-based auto-detection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 1. If user has explicitly chosen a language via the switcher, respect that preference
        $manualChosen = Session::get('manual_locale') || $request->hasCookie('manual_locale');

        if ($manualChosen) {
            if (Session::has('locale') && in_array(Session::get('locale'), ['en', 'bn'])) {
                App::setLocale(Session::get('locale'));
                return $next($request);
            }

            if ($request->hasCookie('locale') && in_array($request->cookie('locale'), ['en', 'bn'])) {
                $loc = $request->cookie('locale');
                App::setLocale($loc);
                Session::put('locale', $loc);
                return $next($request);
            }
        }

        // 2. Intelligent Auto-Detection based on Visitor Country
        // Rule: Bangladesh ('BD') -> 'bn' (Bangla), Any other country -> 'en' (English)
        $country = $this->detectVisitorCountry($request);

        $locale = ($country === 'BD') ? 'bn' : 'en';

        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);
    }

    /**
     * Detect visitor country code (ISO 2-letter).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    private function detectVisitorCountry($request)
    {
        // Step 1: Check CDN / Reverse-Proxy Headers (Cloudflare, CloudFront, cPanel mod_geoip)
        $headers = [
            'HTTP_CF_IPCOUNTRY',
            'CF-IPCountry',
            'X-Country-Code',
            'CloudFront-Viewer-Country',
            'GEOIP_COUNTRY_CODE',
            'HTTP_X_GEOIP_COUNTRY',
        ];

        foreach ($headers as $h) {
            $val = $request->server($h) ?: $request->header($h);
            if (!empty($val) && strlen(trim($val)) === 2) {
                $code = strtoupper(trim($val));
                if ($code !== 'XX' && $code !== 'T1') {
                    return $code;
                }
            }
        }

        // Step 2: Check Client IP via fast cURL Geolocation
        $clientIp = $request->ip();

        if ($clientIp && !in_array($clientIp, ['127.0.0.1', '::1'])) {
            $isPrivate = filter_var(
                $clientIp,
                FILTER_VALIDATE_IP,
                FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
            ) === false;

            if (!$isPrivate) {
                $cacheKey = 'geo_country_' . md5($clientIp);
                $countryFromIp = Cache::remember($cacheKey, 86400, function () use ($clientIp) {
                    return $this->lookupIpCountry($clientIp);
                });

                if (!empty($countryFromIp)) {
                    return $countryFromIp;
                }
            }
        }

        // Step 3: Check Browser Accept-Language header (bn, bn-BD, en-BD)
        $acceptLang = strtolower($request->server('HTTP_ACCEPT_LANGUAGE', ''));
        if (strpos($acceptLang, 'bn') !== false || strpos($acceptLang, '-bd') !== false || strpos($acceptLang, '_bd') !== false) {
            return 'BD';
        }

        // Step 4: Check environment timezone
        if (date_default_timezone_get() === 'Asia/Dhaka' || config('app.timezone') === 'Asia/Dhaka') {
            return 'BD';
        }

        return 'US';
    }

    /**
     * Look up country code using cURL with stream fallback.
     *
     * @param string $ip
     * @return string|null
     */
    private function lookupIpCountry($ip)
    {
        if (function_exists('curl_init')) {
            $ch = curl_init("http://ip-api.com/json/{$ip}?fields=countryCode");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            $res = curl_exec($ch);
            curl_close($ch);

            if ($res) {
                $json = json_decode($res, true);
                if (!empty($json['countryCode'])) {
                    return strtoupper(trim($json['countryCode']));
                }
            }
        }

        // Stream fallback
        try {
            $ctx = stream_context_create(['http' => ['timeout' => 2]]);
            $res = @file_get_contents("http://ip-api.com/json/{$ip}?fields=countryCode", false, $ctx);
            if ($res) {
                $json = json_decode($res, true);
                if (!empty($json['countryCode'])) {
                    return strtoupper(trim($json['countryCode']));
                }
            }
        } catch (\Exception $e) {
            // Ignore network errors
        }

        return null;
    }
}
