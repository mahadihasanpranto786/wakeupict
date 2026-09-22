<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class FacebookPostController extends Controller
{
    /**
     * Display Facebook Page Posts with pagination (9 per page).
     */
    public function index(Request $request)
    {
        $pageId = app_setting('facebook_page_id', 'wakeupict');
        $accessToken = app_setting('facebook_access_token');
        $pageName = app_setting('facebook_page_name', 'Wake Up ICT');

        $isConfigured = !empty($accessToken) && !empty($pageId);
        $posts = [];
        $apiError = null;

        if ($isConfigured) {
            $cacheKey = 'facebook_page_posts_' . md5($pageId . $accessToken);

            // Allow manual / auto refresh (?refresh=1 or ?sync=1)
            if ($request->has('refresh') || $request->has('sync')) {
                Cache::forget($cacheKey);
            }

            $cachedPosts = Cache::get($cacheKey);

            if ($cachedPosts !== null && is_array($cachedPosts) && !empty($cachedPosts)) {
                $posts = $cachedPosts;
            } else {
                $fields = 'id,message,created_time,full_picture,permalink_url,shares,reactions.summary(total_count),comments.summary(total_count)';
                $url = "https://graph.facebook.com/v19.0/{$pageId}/posts?fields={$fields}&limit=100&access_token={$accessToken}";

                $fetchResult = $this->fetchGraphApi($url);

                if ($fetchResult['success']) {
                    $json = json_decode($fetchResult['body'], true);
                    if (isset($json['data']) && is_array($json['data'])) {
                        $posts = $json['data'];
                    } elseif (is_array($json) && !isset($json['error'])) {
                        $posts = $json;
                    } elseif (isset($json['error'])) {
                        $apiError = $json['error']['message'] ?? 'Unknown Facebook Graph API error.';
                    }
                } else {
                    $apiError = $fetchResult['error'];
                }
            }
        }

        // 1. Unwrap nested 'data' key if raw response or associative array was cached
        if (isset($posts['data']) && is_array($posts['data'])) {
            $posts = $posts['data'];
        }

        // 2. Filter out any invalid items (such as paging cursor objects or blank posts)
        if (is_array($posts)) {
            $posts = array_values(array_filter($posts, function ($p) {
                return is_array($p) && (!empty($p['message']) || !empty($p['full_picture']) || !empty($p['story']));
            }));
        } else {
            $posts = [];
        }

        // 3. Fall back to persistent local storage backup if API returned empty
        if (empty($posts)) {
            $posts = $this->getPersistentOrFallbackPosts($pageName);
        }

        // 4. If valid posts exist, cache with short 3-minute TTL for real-time dynamic sync
        if (!empty($posts)) {
            if (isset($cacheKey) && empty($apiError)) {
                Cache::put($cacheKey, $posts, 180); // 3 minutes TTL ensures real-time sync with Facebook updates
            }
            $this->savePostsBackup($posts);
        }

        // 5. Paginate with 9 posts per page
        $perPage = 9;
        $currentPage = max(1, (int) $request->input('page', 1));
        $total = count($posts);
        $offset = ($currentPage - 1) * $perPage;
        $currentPageItems = array_slice($posts, $offset, $perPage);

        $paginatedPosts = new LengthAwarePaginator(
            $currentPageItems,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('frontend.theme.clasic.facebook_posts.index', [
            'posts' => $paginatedPosts,
            'pageName' => $pageName,
            'pageId' => $pageId,
            'isConfigured' => $isConfigured,
            'apiError' => $apiError,
        ]);
    }

    /**
     * Retrieve posts from persistent storage backup or curated posts.
     */
    private function getPersistentOrFallbackPosts($pageName)
    {
        $backupFile = storage_path('app/facebook_posts_backup.json');
        if (file_exists($backupFile)) {
            $raw = @file_get_contents($backupFile);
            if ($raw) {
                $decoded = json_decode($raw, true);
                if (is_array($decoded) && !empty($decoded)) {
                    $filtered = array_values(array_filter($decoded, function ($p) {
                        return is_array($p) && (!empty($p['message']) || !empty($p['full_picture']) || !empty($p['story']));
                    }));
                    if (!empty($filtered)) {
                        return $filtered;
                    }
                }
            }
        }

        return $this->getCuratedDemoPosts($pageName);
    }

    /**
     * Persist successful posts to disk for zero-downtime offline fallback.
     */
    private function savePostsBackup(array $posts)
    {
        try {
            $dir = storage_path('app');
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            @file_put_contents($dir . '/facebook_posts_backup.json', json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        } catch (\Exception $e) {
            // Ignore backup disk errors
        }
    }

    /**
     * Curated official Wake Up ICT Facebook updates with real photos (guaranteed rich fallback).
     */
    private function getCuratedDemoPosts($pageName)
    {
        return [
            [
                'id' => 'fb_backup_1',
                'message' => "Excel-এ সহজেই শিখুন যোগ, বিয়োগ, গুণ, ভাগ!\nশুরু করুন = দিয়ে, ব্যবহার করুন সঠিক Cell Reference, আর Formula দিয়ে হিসাব করুন আরও দ্রুত।\n\n#ExcelTips #Excel2010 #ComputerTips #MSExcel #ExcelFormula #WakeUpICT",
                'created_time' => Carbon::now()->subDays(2)->toIso8601String(),
                'full_picture' => 'https://scontent.fdac207-1.fna.fbcdn.net/v/t39.30808-6/793945866_1437043425145663_5481484648615298718_n.jpg?stp=dst-jpg_p720x720_tt6&_nc_cat=100&_nc_map=urlgen_bucketless&ccb=1-7&_nc_sid=127cfc&oh=00_AQI2ljnZQGxw2jmNpmP2qFRm4TATkgXJR82sGuZhyYRNHA&oe=6AB8271B',
                'permalink_url' => 'https://facebook.com/1451568857026453/posts/1437047468478592',
                'reactions' => ['summary' => ['total_count' => 6]],
                'comments' => ['summary' => ['total_count' => 1]],
                'shares' => ['count' => 2],
            ],
            [
                'id' => 'fb_backup_2',
                'message' => "**আপনার সফল ক্যারিয়ারের যাত্রা শুরু হোক আজই!** 💻\n\n**বাংলাদেশ কারিগরি শিক্ষা বোর্ড (BTEB) অনুমোদিত**\n**কম্পিউটার অফিস অ্যাপ্লিকেশন (৭৬) কোর্স**\n\nআলহামদুলিল্লাহ! ওয়েক আপ আইসিটি ইনস্টিটিউটের ৪৬তম ব্যাচের ক্লাস ইতোমধ্যেই শুরু হয়েছে।\n\n📍 ঠিকানা: পান্না চত্বর, নান্নু টাওয়ার (৩য় তলা), রাজবাড়ী সদর, রাজবাড়ী।\n📞 যোগাযোগ: 01791-612121\n\n#WakeUpICTInstitute #BTEB #ComputerOfficeApplication #AdmissionOpen #Rajbari",
                'created_time' => Carbon::now()->subDays(5)->toIso8601String(),
                'full_picture' => 'https://scontent.fdac207-1.fna.fbcdn.net/v/t39.30808-6/735354934_1381427370707269_4989191829538195918_n.jpg?stp=dst-jpg_s960x960_tt6&_nc_cat=104&_nc_map=urlgen_bucketless&ccb=1-7&_nc_sid=127cfc&oh=00_AQI8zvuiX5WM6wdipjDn8TLfX-FCbhGld4Zs7muLsGBBNw&oe=6AB82B76',
                'permalink_url' => 'https://facebook.com/1451568857026453/posts/1381431860706820',
                'reactions' => ['summary' => ['total_count' => 22]],
                'comments' => ['summary' => ['total_count' => 2]],
                'shares' => ['count' => 5],
            ],
            [
                'id' => 'fb_backup_3',
                'message' => "🎉 নতুন ব্যাচ শুরু, ভর্তি চলছে! 🎉\n\nবাংলাদেশ কারিগরি শিক্ষা বোর্ড (BTEB) অনুমোদিত কম্পিউটার অফিস অ্যাপ্লিকেশন (৭৬) কোর্স।\n\nআলহামদুলিল্লাহ! ওয়েক আপ আইসিটি ইনস্টিটিউটের ৪৫তম ব্যাচের ক্লাস সফলভাবে শুরু হয়েছে।\n\nযোগাযোগ: 01791-612121\nওয়েক আপ আইসিটি ইনস্টিটিউট — দক্ষতা অর্জনের বিশ্বস্ত ঠিকানা। 💙",
                'created_time' => Carbon::now()->subDays(8)->toIso8601String(),
                'full_picture' => 'https://scontent.fdac207-1.fna.fbcdn.net/v/t39.30808-6/733499831_1380355040814502_4043179439281166785_n.jpg?stp=dst-jpg_s960x960_tt6&_nc_cat=104&_nc_map=urlgen_bucketless&ccb=1-7&_nc_sid=127cfc&oh=00_AQL3CXHu34V-o5Cf3VF7zZmElyFtpjxmPDG0LksozcrVyA&oe=6AB82ABD',
                'permalink_url' => 'https://facebook.com/1451568857026453/posts/1380355354147804',
                'reactions' => ['summary' => ['total_count' => 23]],
                'comments' => ['summary' => ['total_count' => 3]],
                'shares' => ['count' => 4],
            ],
            [
                'id' => 'fb_backup_4',
                'message' => "🎓 বাংলাদেশ কারিগরি শিক্ষাবোর্ড অনুমোদিত \"কম্পিউটার অফিস অ্যাপ্লিকেশন (৭৬)\" সেশনের পরীক্ষা সুষ্ঠু ও সফলভাবে সম্পন্ন হয়েছে। সকল শিক্ষার্থীর উজ্জ্বল ভবিষ্যৎ ও সাফল্য কামনা করছি। শুভকামনা রইল! 💙\n\n#WakeUpICT #ComputerOfficeApplication #BTEB #TechnicalEducation #Rajbari",
                'created_time' => Carbon::now()->subDays(12)->toIso8601String(),
                'full_picture' => 'https://scontent.fdac207-1.fna.fbcdn.net/v/t39.30808-6/731014464_1378806697636003_8050668167405171544_n.jpg?stp=dst-jpg_s960x960_tt6&_nc_cat=106&_nc_map=urlgen_bucketless&ccb=1-7&_nc_sid=127cfc&oh=00_AQIA7sRC73gYSLjruR1ygmbeCRUMruatQ5W-k52mRGdyQg&oe=6AB82136',
                'permalink_url' => 'https://facebook.com/1451568857026453/posts/1378811407635532',
                'reactions' => ['summary' => ['total_count' => 31]],
                'comments' => ['summary' => ['total_count' => 2]],
                'shares' => ['count' => 7],
            ],
            [
                'id' => 'fb_backup_5',
                'message' => "সার্টিফিকেট বিতরণ অনুষ্ঠান সফলভাবে সম্পন্ন হয়েছে।\n\"কম্পিউটার অফিস অ্যাপ্লিকেশন\" কোর্সের শিক্ষার্থীদের মাঝে সনদপত্র প্রদান করা হয়।\nবিশেষ অতিথি হিসেবে উপস্থিত ছিলেন ডা. এন. এ. এম মোমেনুজ্জামান (Momen Uzzaman), চেয়ারম্যান, ওয়েক আপ আইসিটি।\n\nসকল শিক্ষার্থীকে আন্তরিক শুভেচ্ছা ও উজ্জ্বল ভবিষ্যতের শুভকামনা। 💙",
                'created_time' => Carbon::now()->subDays(15)->toIso8601String(),
                'full_picture' => 'https://scontent.fdac207-1.fna.fbcdn.net/v/t39.30808-6/728234524_1376398577876815_2679356163562918254_n.jpg?stp=dst-jpg_s960x960_tt6&_nc_cat=103&_nc_map=urlgen_bucketless&ccb=1-7&_nc_sid=127cfc&oh=00_AQJxlunMTdQIkDJdnmGTlrTX1n0BkqP9R_AhGFvYXBEDeA&oe=6AB83D99',
                'permalink_url' => 'https://facebook.com/1451568857026453/posts/1376401564543183',
                'reactions' => ['summary' => ['total_count' => 24]],
                'comments' => ['summary' => ['total_count' => 3]],
                'shares' => ['count' => 3],
            ],
            [
                'id' => 'fb_backup_6',
                'message' => "🎓 কম্পিউটার অফিস অ্যাপ্লিকেশন কোর্স (জানুয়ারি–জুন ২০২৬ সেশন)-এর টেস্ট পরীক্ষা সফলভাবে সম্পন্ন হয়েছে। অংশগ্রহণকারী সকল শিক্ষার্থীকে আন্তরিক অভিনন্দন। 👏\n\n#WakeUpICT #ComputerEducation #Rajbari",
                'created_time' => Carbon::now()->subDays(18)->toIso8601String(),
                'full_picture' => 'https://scontent.fdac207-1.fna.fbcdn.net/v/t39.30808-6/728293919_1376259181224088_2510994765451261549_n.jpg?stp=dst-jpg_s960x960_tt6&_nc_cat=100&_nc_map=urlgen_bucketless&ccb=1-7&_nc_sid=127cfc&oh=00_AQJTmEceiMukcEnS9-adj-jZyW3fuAbDxHn0_Ij5jwm2yQ&oe=6AB82D1E',
                'permalink_url' => 'https://facebook.com/1451568857026453/posts/1376263514556988',
                'reactions' => ['summary' => ['total_count' => 22]],
                'comments' => ['summary' => ['total_count' => 3]],
                'shares' => ['count' => 4],
            ],
            [
                'id' => 'fb_backup_7',
                'message' => "এসএসসি পরীক্ষার পর নতুন ব্যাচ শুরু! এসএসসি পরীক্ষা শেষ, এখন দক্ষতা অর্জনের সেরা সময়। ওয়েক আপ আইসিটি ইনস্টিটিউটে কম্পিউটার অফিস অ্যাপ্লিকেশন কোর্সের নতুন ব্যাচ শুরু হয়েছে।\n\n#WakeUpICT #SkillDevelopment #SSC2026",
                'created_time' => Carbon::now()->subDays(22)->toIso8601String(),
                'full_picture' => 'https://scontent.fdac207-1.fna.fbcdn.net/v/t39.30808-6/724221618_1368057945377545_7221380812588381536_n.jpg?stp=dst-jpg_s960x960_tt6&_nc_cat=108&_nc_map=urlgen_bucketless&ccb=1-7&_nc_sid=127cfc&oh=00_AQJ92P4ZKU7skhKzZ_GQ2IU2aEpmHFujp6YeBA-hUXxDLA&oe=6AB82E94',
                'permalink_url' => 'https://facebook.com/1451568857026453/posts/1368061772043829',
                'reactions' => ['summary' => ['total_count' => 12]],
                'comments' => ['summary' => ['total_count' => 3]],
                'shares' => ['count' => 2],
            ],
            [
                'id' => 'fb_backup_8',
                'message' => "🌙✨ Eid Al-Adha 2026 Mubarak ✨🌙\nMay this blessed occasion bring peace, happiness, prosperity, and countless blessings to you and your family. 🤍\n\nEid Mubarak from Wake Up ICT 🌊\n#EidAlAdha2026 #eidmubarak #WakeUpICT",
                'created_time' => Carbon::now()->subDays(25)->toIso8601String(),
                'full_picture' => 'https://scontent.fdac207-1.fna.fbcdn.net/v/t39.30808-6/706156025_1352343506948989_6511932693711577383_n.jpg?stp=dst-jpg_s720x720_tt6&_nc_cat=104&_nc_map=urlgen_bucketless&ccb=1-7&_nc_sid=127cfc&oh=00_AQI03i84M7_2_m5mI6E4g5a7bF14eC_s4j962_v77uM2w&oe=6AB823D5',
                'permalink_url' => 'https://facebook.com/1451568857026453/posts/1352346546948685',
                'reactions' => ['summary' => ['total_count' => 5]],
                'comments' => ['summary' => ['total_count' => 0]],
                'shares' => ['count' => 1],
            ],
            [
                'id' => 'fb_backup_9',
                'message' => "কুইজ প্রতিযোগিতা ২০২৬ | অফিসিয়াল ঘোষণা\nপহেলা বৈশাখ ও ICT Fest ২০২৬ উপলক্ষে আয়োজিত কুইজে অংশগ্রহণকারী সবাইকে ধন্যবাদ। বিজয়ীদের জানাই আন্তরিক অভিনন্দন।\n\n#WakeUpICT #QuizCompetition #Winners",
                'created_time' => Carbon::now()->subDays(30)->toIso8601String(),
                'full_picture' => 'https://scontent.fdac207-1.fna.fbcdn.net/v/t39.30808-6/721248668_1368151825368157_6074088642340809771_n.png?_nc_cat=102&_nc_map=urlgen_bucketless&ccb=1-7&_nc_sid=cc71e4&oh=00_AQL2haVpmPtY7UJcowyhCPHES7w9g7WVMNkXPZMDcA4iig&oe=6AB82324',
                'permalink_url' => 'https://facebook.com/wakeupict',
                'reactions' => ['summary' => ['total_count' => 10]],
                'comments' => ['summary' => ['total_count' => 1]],
                'shares' => ['count' => 2],
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

