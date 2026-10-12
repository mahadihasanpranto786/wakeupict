<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class FrontendMenu extends Model
{
    protected $table = 'frontend_menus';

    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
        'order_index' => 'integer',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order_index', 'asc');
    }

    public function activeChildren()
    {
        return $this->hasMany(self::class, 'parent_id')
            ->where('status', true)
            ->orderBy('order_index', 'asc');
    }

    /**
     * Get Localized Menu Title
     */
    public function getTitle()
    {
        if (App::getLocale() === 'bn' && !empty($this->title_bn)) {
            return $this->title_bn;
        }

        return $this->title_en ?: $this->title_bn;
    }

    /**
     * Intelligently resolve the target URL
     */
    public function resolveUrl()
    {
        if (!empty($this->route_name) && Route::has($this->route_name)) {
            try {
                return route($this->route_name);
            } catch (\Exception $e) {
                // Ignore route generation errors with missing parameters
            }
        }

        if (empty($this->url) || $this->url === '#') {
            return '#';
        }

        if (preg_match('/^(http:\/\/|https:\/\/|\/\/|#|mailto:|tel:)/i', $this->url)) {
            return $this->url;
        }

        if (Route::has($this->url)) {
            try {
                return route($this->url);
            } catch (\Exception $e) {
                // fall through
            }
        }

        return url($this->url);
    }

    /**
     * Check if this menu is the current active page
     */
    public function isCurrent()
    {
        if (!empty($this->route_name) && request()->routeIs($this->route_name)) {
            return true;
        }

        if (!empty($this->url) && $this->url !== '#') {
            $trimmed = trim($this->url, '/');
            if (!empty($trimmed) && (request()->is($trimmed) || request()->is($trimmed . '/*'))) {
                return true;
            }

            if (request()->url() === $this->resolveUrl()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if any active child is active
     */
    public function isChildCurrent()
    {
        foreach ($this->activeChildren as $child) {
            if ($child->isCurrent()) {
                return true;
            }
        }
        return false;
    }
}
