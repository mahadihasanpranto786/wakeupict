<?php

namespace App\Services;

use App\model\FrontendMenu;
use Illuminate\Support\Facades\Cache;

class FrontendMenuService
{
    const CACHE_KEY_PREFIX = 'frontend_menus_tree_';

    /**
     * Get active menu tree for specific location (cached)
     */
    public static function getTree($location = 'header')
    {
        return Cache::rememberForever(self::CACHE_KEY_PREFIX . $location, function () use ($location) {
            $menus = FrontendMenu::where('location', $location)
                ->whereNull('parent_id')
                ->where('status', true)
                ->with(['activeChildren' => function ($q) {
                    $q->orderBy('order_index', 'asc');
                }])
                ->orderBy('order_index', 'asc')
                ->get();

            // Auto-seed defaults if table is empty
            if ($menus->isEmpty() && FrontendMenu::where('location', $location)->count() === 0) {
                self::seedDefaults($location);
                return FrontendMenu::where('location', $location)
                    ->whereNull('parent_id')
                    ->where('status', true)
                    ->with('activeChildren')
                    ->orderBy('order_index', 'asc')
                    ->get();
            }

            return $menus;
        });
    }

    /**
     * Clear frontend menu cache
     */
    public static function clearCache()
    {
        Cache::forget(self::CACHE_KEY_PREFIX . 'header');
        Cache::forget(self::CACHE_KEY_PREFIX . 'footer_quick');
        Cache::forget(self::CACHE_KEY_PREFIX . 'footer_services');
        Cache::forget(self::CACHE_KEY_PREFIX . 'footer_legal');
    }

    /**
     * Seed standard default menus for Wake Up ICT frontend
     */
    public static function seedDefaults($location = null)
    {
        self::clearCache();

        if (!$location || $location === 'header') {
            FrontendMenu::where('location', 'header')->delete();

            $headerMenus = [
                [
                    'location' => 'header',
                    'title_en' => 'Home',
                    'title_bn' => 'হোম',
                    'route_name' => 'home-page',
                    'url' => '/',
                    'order_index' => 1,
                    'status' => true,
                ],
                [
                    'location' => 'header',
                    'title_en' => 'About',
                    'title_bn' => 'আমাদের সম্পর্কে',
                    'route_name' => 'about-page',
                    'url' => '/about',
                    'order_index' => 2,
                    'status' => true,
                ],
                [
                    'location' => 'header',
                    'title_en' => 'Courses',
                    'title_bn' => 'কোর্সসমূহ',
                    'route_name' => 'academic-training',
                    'url' => '/courses',
                    'order_index' => 3,
                    'status' => true,
                ],
                [
                    'location' => 'header',
                    'title_en' => 'Services',
                    'title_bn' => 'সেবাসমূহ',
                    'route_name' => 'services-page',
                    'url' => '/services',
                    'order_index' => 4,
                    'status' => true,
                ],
                [
                    'location' => 'header',
                    'title_en' => 'Blog',
                    'title_bn' => 'ব্লগ',
                    'route_name' => 'our-blogs',
                    'url' => '/blog',
                    'order_index' => 5,
                    'status' => true,
                ],
                [
                    'location' => 'header',
                    'title_en' => 'Facebook Posts',
                    'title_bn' => 'ফেসবুক পোস্ট',
                    'route_name' => 'facebook-posts',
                    'url' => '/facebook-posts',
                    'icon' => 'fa fa-facebook-square',
                    'order_index' => 6,
                    'status' => true,
                ],
            ];

            foreach ($headerMenus as $item) {
                FrontendMenu::create($item);
            }
        }

        if (!$location || $location === 'footer_quick') {
            FrontendMenu::where('location', 'footer_quick')->delete();

            $footerQuick = [
                [
                    'location' => 'footer_quick',
                    'title_en' => 'About Us',
                    'title_bn' => 'আমাদের সম্পর্কে',
                    'route_name' => 'about-page',
                    'url' => '/about',
                    'order_index' => 1,
                    'status' => true,
                ],
                [
                    'location' => 'footer_quick',
                    'title_en' => 'Professional Courses',
                    'title_bn' => 'প্রফেশনাল কোর্সসমূহ',
                    'route_name' => 'academic-training',
                    'url' => '/courses',
                    'order_index' => 2,
                    'status' => true,
                ],
                [
                    'location' => 'footer_quick',
                    'title_en' => 'IT Services & Solutions',
                    'title_bn' => 'আইটি সার্ভিস ও সলিউশন',
                    'route_name' => 'services-page',
                    'url' => '/services',
                    'order_index' => 3,
                    'status' => true,
                ],
                [
                    'location' => 'footer_quick',
                    'title_en' => 'Latest Technology Articles',
                    'title_bn' => 'প্রযুক্তি ব্লগ ও আপডেট',
                    'route_name' => 'our-blogs',
                    'url' => '/blog',
                    'order_index' => 4,
                    'status' => true,
                ],
                [
                    'location' => 'footer_quick',
                    'title_en' => 'Contact & Support',
                    'title_bn' => 'যোগাযোগ ও সাপোর্ট',
                    'route_name' => 'contact-us-page',
                    'url' => '/contact-us',
                    'order_index' => 5,
                    'status' => true,
                ],
            ];

            foreach ($footerQuick as $item) {
                FrontendMenu::create($item);
            }
        }
    }
}
