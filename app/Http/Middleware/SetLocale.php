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
        // 1. If user has manually chosen a locale (stored in session or cookie), prioritize that unconditionally
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            if (in_array($locale, ['en', 'bn'])) {
                App::setLocale($locale);
                return $next($request);
            }
        }

        if ($request->hasCookie('locale')) {
            $locale = $request->cookie('locale');
            if (in_array($locale, ['en', 'bn'])) {
                App::setLocale($locale);
                Session::put('locale', $locale);
                return $next($request);
            }
        }

        // 2. Intelligent Auto-Detection based on Visitor Country
        $detectedCountry = null;

        // Check CDN / Reverse-Proxy Headers
        $headersToCheck = [
            'HTTP_CF_IPCOUNTRY',
            'CF-IPCountry',
            'X-Country-Code',
            'CloudFront-Viewer-Country'
        ];

        foreach ($headersToCheck as $h) {
            if ($val = $request->server($h) ?: $request->header($h)) {
                $detectedCountry = strtoupper(trim($val));
                break;
            }
        }

        $clientIp = $request->ip();

        // If no proxy header, perform IP geolocation lookup with caching
        if (!$detectedCountry && $clientIp) {
            $isLocal = in_array($clientIp, ['127.0.0.1', '::1']) ||
                       strpos($clientIp, '192.168.') === 0 ||
                       strpos($clientIp, '10.') === 0;

            if ($isLocal) {
                // In local development, check browser Accept-Language or system timezone
                $acceptLang = strtolower($request->server('HTTP_ACCEPT_LANGUAGE', ''));
                if (strpos($acceptLang, 'bn') !== false) {
                    $detectedCountry = 'BD';
                } elseif (date_default_timezone_get() === 'Asia/Dhaka') {
                    $detectedCountry = 'BD';
                } else {
                    $detectedCountry = 'US';
                }
            } else {
                $cacheKey = 'ip_country_' . md5($clientIp);
                $detectedCountry = Cache::remember($cacheKey, 86400, function () use ($clientIp) {
                    try {
                        $ctx = stream_context_create(['http' => ['timeout' => 1.5]]);
                        $res = @file_get_contents("http://ip-api.com/json/{$clientIp}?fields=countryCode", false, $ctx);
                        if ($res) {
                            $data = json_decode($res, true);
                            return isset($data['countryCode']) ? strtoupper($data['countryCode']) : 'US';
                        }
                    } catch (\Exception $e) {
                        return 'US';
                    }
                    return 'US';
                });
            }
        }

        // Rule: Bangladesh (BD) -> Bangla ('bn'), All others -> English ('en')
        $locale = ($detectedCountry === 'BD') ? 'bn' : 'en';

        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);
    }
}
