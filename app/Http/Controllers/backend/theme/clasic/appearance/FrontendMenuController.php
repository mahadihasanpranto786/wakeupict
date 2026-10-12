<?php

namespace App\Http\Controllers\backend\theme\clasic\appearance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\FrontendMenu;
use App\Services\FrontendMenuService;

class FrontendMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display frontend menus editor
     */
    public function index(Request $request)
    {
        $location = $request->get('location', 'header');
        if (!in_array($location, ['header', 'footer_quick', 'footer_services', 'footer_legal'])) {
            $location = 'header';
        }

        // Auto-seed if empty
        if (FrontendMenu::where('location', $location)->count() === 0) {
            FrontendMenuService::seedDefaults($location);
        }

        $menus = FrontendMenu::where('location', $location)
            ->whereNull('parent_id')
            ->with(['children' => function ($q) {
                $q->orderBy('order_index', 'asc');
            }])
            ->orderBy('order_index', 'asc')
            ->get();

        $parentOptions = FrontendMenu::where('location', $location)
            ->whereNull('parent_id')
            ->orderBy('order_index', 'asc')
            ->get();

        return view('backend.theme.clasic.appearance.menus.index', compact('menus', 'parentOptions', 'location'));
    }

    /**
     * Store new frontend menu item
     */
    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|in:header,footer_quick,footer_services,footer_legal',
            'title_en' => 'required|string|max:191',
            'title_bn' => 'nullable|string|max:191',
            'parent_id' => 'nullable|exists:frontend_menus,id',
            'url' => 'nullable|string|max:255',
            'route_name' => 'nullable|string|max:191',
            'target' => 'required|in:_self,_blank',
            'icon' => 'nullable|string|max:100',
            'badge_text' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer',
        ]);

        $maxOrder = FrontendMenu::where('location', $request->location)
            ->where('parent_id', $request->parent_id)
            ->max('order_index') ?: 0;

        FrontendMenu::create([
            'location' => $request->location,
            'parent_id' => $request->parent_id ?: null,
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'url' => $request->url ?: '#',
            'route_name' => $request->route_name,
            'target' => $request->target ?: '_self',
            'icon' => $request->icon,
            'badge_text' => $request->badge_text,
            'badge_color' => $request->badge_color ?: 'brand-primary',
            'order_index' => $request->filled('order_index') ? $request->order_index : ($maxOrder + 1),
            'status' => true,
        ]);

        FrontendMenuService::clearCache();

        return redirect()->route('admin.appearance.menus.index', ['location' => $request->location])
            ->with('success', 'Frontend menu item created successfully.');
    }

    /**
     * Update existing frontend menu item
     */
    public function update(Request $request, $id)
    {
        $menu = FrontendMenu::findOrFail($id);

        $request->validate([
            'title_en' => 'required|string|max:191',
            'title_bn' => 'nullable|string|max:191',
            'parent_id' => 'nullable|exists:frontend_menus,id',
            'url' => 'nullable|string|max:255',
            'route_name' => 'nullable|string|max:191',
            'target' => 'required|in:_self,_blank',
            'icon' => 'nullable|string|max:100',
            'badge_text' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:50',
            'order_index' => 'required|integer',
        ]);

        // Prevent setting self as parent
        $parentId = $request->parent_id;
        if ($parentId == $menu->id) {
            $parentId = null;
        }

        $menu->update([
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'parent_id' => $parentId,
            'url' => $request->url ?: '#',
            'route_name' => $request->route_name,
            'target' => $request->target,
            'icon' => $request->icon,
            'badge_text' => $request->badge_text,
            'badge_color' => $request->badge_color ?: 'brand-primary',
            'order_index' => $request->order_index,
        ]);

        FrontendMenuService::clearCache();

        return redirect()->route('admin.appearance.menus.index', ['location' => $menu->location])
            ->with('success', 'Menu item updated successfully.');
    }

    /**
     * Toggle menu active/inactive status
     */
    public function toggle($id)
    {
        $menu = FrontendMenu::findOrFail($id);
        $menu->status = !$menu->status;
        $menu->save();

        FrontendMenuService::clearCache();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'active' => $menu->status,
                'message' => 'Menu visibility updated.',
            ]);
        }

        return redirect()->back()->with('success', 'Menu status updated successfully.');
    }

    /**
     * Reset menu location to factory defaults
     */
    public function resetDefaults(Request $request)
    {
        $location = $request->get('location', 'header');
        FrontendMenuService::seedDefaults($location);

        return redirect()->route('admin.appearance.menus.index', ['location' => $location])
            ->with('success', 'Frontend menus restored to system defaults.');
    }

    /**
     * Delete menu item
     */
    public function destroy($id)
    {
        $menu = FrontendMenu::findOrFail($id);
        $location = $menu->location;

        // Re-assign or delete child items
        FrontendMenu::where('parent_id', $menu->id)->update(['parent_id' => null]);
        $menu->delete();

        FrontendMenuService::clearCache();

        return redirect()->route('admin.appearance.menus.index', ['location' => $location])
            ->with('success', 'Menu item removed successfully.');
    }
}
