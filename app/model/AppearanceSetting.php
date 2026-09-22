<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;

class AppearanceSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * Get a setting value with automatic locale detection (or fallback).
     *
     * @param string $key
     * @param mixed $default
     * @param string|null $locale
     * @return mixed
     */
    public static function getVal($key, $default = null, $locale = null)
    {
        $settings = Cache::remember('appearance_settings_all', 3600, function () {
            return self::all()->keyBy('key');
        });

        if (!isset($settings[$key])) {
            return $default;
        }

        $item = $settings[$key];
        $locale = $locale ?: App::getLocale();

        if ($locale === 'bn') {
            return (!empty($item->value_bn)) ? $item->value_bn : (!empty($item->value_en) ? $item->value_en : $default);
        }

        return (!empty($item->value_en)) ? $item->value_en : (!empty($item->value_bn) ? $item->value_bn : $default);
    }

    /**
     * Set or update a setting.
     */
    public static function setVal($key, $valueEn, $valueBn = null, $section = 'global', $meta = null)
    {
        $data = [
            'section' => $section,
            'value_en' => $valueEn,
        ];

        if ($valueBn !== null) {
            $data['value_bn'] = $valueBn;
        }

        if ($meta !== null) {
            $data['meta'] = is_array($meta) ? json_encode($meta) : $meta;
        }

        $res = self::updateOrCreate(['key' => $key], $data);
        Cache::forget('appearance_settings_all');
        return $res;
    }
}
