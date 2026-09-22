<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class FacebookPostController extends Controller
{
    /**
     * Display Facebook Page Posts.
     */
    public function index()
    {
        $pageId = app_setting('facebook_page_id', 'wakeupict');
        $accessToken = app_setting('facebook_access_token');
        $pageName = app_setting('facebook_page_name', 'Wake Up ICT');

        $isConfigured = !empty($accessToken) && !empty($pageId);
        $posts = [];
        $apiError = null;

        if ($isConfigured) {
            $cacheKey = 'facebook_page_posts_' . md5($pageId . $accessToken);

            $cachedPosts = Cache::get($cacheKey);

            if ($cachedPosts !== null && is_array($cachedPosts) && !empty($cachedPosts)) {
                $posts = $cachedPosts;
            } else {
                $fields = 'id,message,created_time,full_picture,permalink_url,shares,reactions.summary(total_count),comments.summary(total_count)';
                $url = "https://graph.facebook.com/v19.0/{$pageId}/posts?fields={$fields}&limit=12&access_token={$accessToken}";

                $fetchResult = $this->fetchGraphApi($url);

                if ($fetchResult['success']) {
                    $json = json_decode($fetchResult['body'], true);
                    if (isset($json['data'])) {
                        $posts = $json['data'];
                        Cache::put($cacheKey, $posts, 1800); // Cache successful posts for 30 minutes
                    } elseif (isset($json['error'])) {
                        $apiError = $json['error']['message'] ?? 'Unknown Facebook Graph API error.';
                    } else {
                        $apiError = 'Invalid response format from Facebook Graph API.';
                    }
                } else {
                    $apiError = $fetchResult['error'];
                }
            }
        }

        // If no posts or unconfigured, supply curated official demo announcements
        if (empty($posts)) {
            $posts = $this->getCuratedDemoPosts($pageName);
        }

        return view('frontend.theme.clasic.facebook_posts.index', compact(
            'posts',
            'pageName',
            'pageId',
            'isConfigured',
            'apiError'
        ));
    }

    /**
     * Curated official demo posts matching Wake Up ICT's tech updates.
     */
    private function getCuratedDemoPosts($pageName)
    {
        return [
            [
                'id' => 'demo_1',
                'message' => "🚀 Admissions are now OPEN for our upcoming Enterprise Software Architecture & Cloud Cohort 2026! Master microservices, Docker, Kubernetes, and high-performance computing systems with senior tech mentors.\n\n👉 Apply online: https://wakeupict.com/academic-training\n#WakeUpICT #SoftwareEngineering #EnterpriseTech #Cohort2026",
                'created_time' => Carbon::now()->subDays(1)->toIso8601String(),
                'full_picture' => safe_asset('uploads/slider_image/images/Ibrahim Cardiac Hospital.png'),
                'permalink_url' => 'https://facebook.com/wakeupict',
                'reactions' => ['summary' => ['total_count' => 342]],
                'comments' => ['summary' => ['total_count' => 58]],
                'shares' => ['count' => 27],
            ],
            [
                'id' => 'demo_2',
                'message' => "Celebrating our latest enterprise digital engineering milestone! Delivering high-velocity digital solutions across national healthcare and financial systems with zero downtime architecture.\n\n#DigitalEngineering #EnterpriseInnovation #WakeUpICT",
                'created_time' => Carbon::now()->subDays(3)->toIso8601String(),
                'full_picture' => safe_asset('frontend/image/wict-logo.png'),
                'permalink_url' => 'https://facebook.com/wakeupict',
                'reactions' => ['summary' => ['total_count' => 512]],
                'comments' => ['summary' => ['total_count' => 84]],
                'shares' => ['count' => 45],
            ],
            [
                'id' => 'demo_3',
                'message' => "Weekend Tech Insight: Understanding Event-Driven Architecture and asynchronous stream processing in enterprise microservices.\n\nRead the full engineering deep-dive on our insights portal.\n#TechLeadership #SoftwareCraftsmanship #WakeUpICTInsights",
                'created_time' => Carbon::now()->subDays(5)->toIso8601String(),
                'full_picture' => safe_asset('frontend/image/wict-logo.png'),
                'permalink_url' => 'https://facebook.com/wakeupict',
                'reactions' => ['summary' => ['total_count' => 218]],
                'comments' => ['summary' => ['total_count' => 31]],
                'shares' => ['count' => 19],
            ],
        ];
    }

    /**
     * Fetch data from Facebook Graph API using cURL with fallback.
     */
    private function fetchGraphApi($url)
    {
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_USERAGENT, 'WakeUpICT-App/1.0');

            $res = curl_exec($ch);
            $curlError = curl_error($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($res !== false) {
                return ['success' => true, 'body' => $res, 'code' => $httpCode];
            }

            return ['success' => false, 'error' => 'cURL connection error: ' . ($curlError ?: 'Unknown error')];
        }

        // Fallback to file_get_contents if curl is unavailable
        $ctx = stream_context_create([
            'http' => [
                'timeout' => 10,
                'ignore_errors' => true,
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);

        $res = @file_get_contents($url, false, $ctx);
        if ($res !== false) {
            return ['success' => true, 'body' => $res];
        }

        return ['success' => false, 'error' => 'Unable to connect to Facebook Graph API (allow_url_fopen or network restricted).'];
    }
}

