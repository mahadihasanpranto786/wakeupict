<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\model\FrontendMenu;
use App\Services\FrontendMenuService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FrontendMenuManagementTest extends TestCase
{
    use DatabaseTransactions;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::first() ?: User::create([
            'name' => 'Admin Test User',
            'email' => 'admin_menu_test_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
        ]);
    }

    /**
     * Unauthenticated user cannot access frontend menu management
     */
    public function test_unauthenticated_user_cannot_access_frontend_menu_builder()
    {
        $response = $this->get(route('admin.appearance.menus.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Authenticated admin can view frontend menus
     */
    public function test_authenticated_admin_can_view_frontend_menus()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.appearance.menus.index', ['location' => 'header']));

        $response->assertStatus(200);
        $response->assertSee('Universal Frontend Navigation &amp; Menu Builder');
        $response->assertSee('Courses');
        $response->assertSee('About');
    }

    /**
     * Admin can create a new frontend menu item
     */
    public function test_admin_can_create_new_frontend_menu_item()
    {
        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.appearance.menus.store'), [
                'location' => 'header',
                'title_en' => 'Special Workshops',
                'title_bn' => 'বিশেষ ওয়ার্কশপ',
                'url' => '/workshops',
                'target' => '_self',
                'icon' => 'fa fa-laptop',
                'badge_text' => 'Hot',
                'badge_color' => 'brand-primary',
                'order_index' => 10,
            ]);

        $this->assertDatabaseHas('frontend_menus', [
            'location' => 'header',
            'title_en' => 'Special Workshops',
            'url' => '/workshops',
        ]);

        FrontendMenu::where('location', 'header')->where('title_en', 'Special Workshops')->delete();
        FrontendMenuService::clearCache();

        $response->assertRedirect(route('admin.appearance.menus.index', ['location' => 'header']));
    }

    /**
     * Admin can update an existing frontend menu item
     */
    public function test_admin_can_update_frontend_menu_item()
    {
        $menu = FrontendMenu::where('location', 'header')->first();

        $response = $this->actingAs($this->adminUser)
            ->put(route('admin.appearance.menus.update', $menu->id), [
                'title_en' => 'Updated Home Label',
                'title_bn' => 'আপডেট হোম',
                'url' => '/',
                'route_name' => 'home-page',
                'target' => '_self',
                'order_index' => 1,
            ]);

        $this->assertDatabaseHas('frontend_menus', [
            'id' => $menu->id,
            'title_en' => 'Updated Home Label',
        ]);

        $response->assertRedirect(route('admin.appearance.menus.index', ['location' => 'header']));
    }

    /**
     * Admin can toggle visibility
     */
    public function test_admin_can_toggle_frontend_menu_visibility()
    {
        $menu = FrontendMenu::where('location', 'header')->first();
        $originalStatus = $menu->status;

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.appearance.menus.toggle', $menu->id));

        $menu->refresh();
        $this->assertEquals(!$originalStatus, $menu->status);
    }

    /**
     * Admin can delete a menu item
     */
    public function test_admin_can_delete_frontend_menu_item()
    {
        $menu = FrontendMenu::create([
            'location' => 'header',
            'title_en' => 'Temporary Delete Test Menu',
            'url' => '/temp',
            'target' => '_self',
            'status' => true,
        ]);

        $response = $this->actingAs($this->adminUser)
            ->delete(route('admin.appearance.menus.destroy', $menu->id));

        $this->assertDatabaseMissing('frontend_menus', [
            'id' => $menu->id,
        ]);
    }

    /**
     * Public page renders dynamic frontend navigation
     */
    public function test_public_homepage_renders_dynamic_frontend_menus()
    {
        $testMenu = FrontendMenu::create([
            'location' => 'header',
            'title_en' => 'Unique Dynamic Link 2026',
            'url' => '/unique-test',
            'target' => '_self',
            'status' => true,
            'order_index' => 99,
        ]);

        FrontendMenuService::clearCache();

        try {
            $response = $this->get(route('home-page'));
            $response->assertStatus(200);
            $response->assertSee('Unique Dynamic Link 2026');
        } finally {
            $testMenu->delete();
            FrontendMenuService::clearCache();
        }
    }
}
