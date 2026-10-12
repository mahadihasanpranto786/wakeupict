<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class StudentPanelMenu extends Model
{
    protected $table = 'student_panel_menus';

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'order_index' => 'integer',
        'meta' => 'array',
    ];

    /**
     * Submenu children relationship
     */
    public function children()
    {
        return $this->hasMany(StudentPanelMenu::class, 'parent_id', 'id')
            ->orderBy('order_index', 'asc')
            ->orderBy('id', 'asc');
    }

    /**
     * Active children relationship
     */
    public function activeChildren()
    {
        return $this->hasMany(StudentPanelMenu::class, 'parent_id', 'id')
            ->where('is_active', true)
            ->orderBy('order_index', 'asc')
            ->orderBy('id', 'asc');
    }

    /**
     * Parent menu relationship
     */
    public function parent()
    {
        return $this->belongsTo(StudentPanelMenu::class, 'parent_id', 'id');
    }

    /**
     * Scope only top-level (parent) menus
     */
    public function scopeParents($query)
    {
        return $query->where(function ($q) {
            $q->where('parent_id', 0)->orWhereNull('parent_id');
        });
    }

    /**
     * Scope active menus
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Localized title getter
     */
    public function getTitle($locale = null)
    {
        $locale = $locale ?: App::getLocale();
        if ($locale === 'bn' && !empty($this->title_bn)) {
            return $this->title_bn;
        }
        return $this->title_en ?: $this->title_bn;
    }

    /**
     * Resolve target URL
     */
    public function resolveUrl()
    {
        if (!empty($this->route_name) && Route::has($this->route_name)) {
            return route($this->route_name);
        }

        if (!empty($this->url)) {
            return url($this->url);
        }

        return '#';
    }

    /**
     * Check if current route or URL is active
     */
    public function isCurrent()
    {
        if (!empty($this->route_name) && request()->routeIs($this->route_name . '*')) {
            return true;
        }

        if (!empty($this->url)) {
            $trimmed = trim($this->url, '/');
            if (request()->is($trimmed) || request()->is($trimmed . '/*')) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if any child menu item is current
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
