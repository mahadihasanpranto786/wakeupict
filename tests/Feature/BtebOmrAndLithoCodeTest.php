<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\model\StudentAccount;
use App\model\StudentPanelMenu;
use App\Services\OmrService;
use App\Services\StudentMenuService;
use Illuminate\Support\Facades\Hash;

class BtebOmrAndLithoCodeTest extends TestCase
{
    protected $adminUser;
    protected $student;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::first() ?: User::create([
            'name'        => 'Admin User',
            'email'       => 'admin_omr_' . rand(1000, 9999) . '@wakeupict.test',
            'password'    => Hash::make('password123'),
            'excess_type' => 'admin',
        ]);

        $this->student = StudentAccount::create([
            'student_id_code' => 'WUICT-2026-' . rand(1000, 9999),
            'name'            => 'BTEB Test Student',
            'phone'           => '01711' . rand(100000, 999999),
            'email'           => 'student_omr_' . rand(1000, 9999) . '@wakeupict.test',
            'password'        => Hash::make('secret123'),
            'status'          => 1,
        ]);
    }

    protected function tearDown(): void
    {
        if ($this->student) {
            $this->student->delete();
        }
        parent::tearDown();
    }

    /**
     * Test 1: OmrService unit capabilities
     */
    public function test_omr_service_generates_valid_litho_code_and_svgs()
    {
        $code = OmrService::generateLithoCode('20');
        $this->assertEquals(10, strlen($code));
        $this->assertStringStartsWith('20', $code);

        // Batch generation
        $batch = OmrService::generateBatch('2078873060', 3);
        $this->assertCount(3, $batch);
        $this->assertEquals('2078873060', $batch[0]);
        $this->assertEquals('2078873061', $batch[1]);
        $this->assertEquals('2078873062', $batch[2]);

        // Barcode SVG
        $barcode = OmrService::generateBarcodeSvg($code);
        $this->assertStringContainsString('<svg', $barcode);
        $this->assertStringContainsString('<rect', $barcode);

        // QR SVG
        $qr = OmrService::generateQrSvg("TEST-DATA");
        $this->assertStringContainsString('<svg', $qr);

        // Bengali digits
        $bn = OmrService::toBengaliDigits('2026');
        $this->assertEquals('২০২৬', $bn);
    }

    /**
     * Test 2: Admin can access BTEB OMR Sheet builder page in Admin layout
     */
    public function test_admin_can_view_bteb_omr_sheet_builder()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.bteb-omr.index'));

        $response->assertStatus(200);
        $response->assertSee('বাংলাদেশ কারিগরি শিক্ষা বোর্ড');
        $response->assertSee('ওএমআর শিট ও লিথু কোড বিল্ডার');
        $response->assertSee('রেজিস্ট্রেশন নম্বর');
        $response->assertSee('কারিকুলাম');
        $response->assertSee('রেজিস্ট্রেশন নম্বর নিজেরটা লিখবেন। (ডানদিক থেকে লিখবেন)');
        $response->assertSee('রোল নম্বর');
        $response->assertSee('omr-header-cell');
        $response->assertSee('সাইজ:');
        $response->assertSee('ব্ল্যাঙ্ক প্র্যাকটিস');
    }

    /**
     * Test 3: Standalone clean print view with batch multi-page and variant page size (A4, Legal, Letter)
     */
    public function test_bteb_omr_sheet_batch_print_view_with_variant_page_sizes()
    {
        // A4 Print
        $responseA4 = $this->actingAs($this->adminUser)
            ->get(route('admin.bteb-omr.print', [
                'start_litho' => '2078873062',
                'count'       => 2,
                'mode'        => 'guide',
                'page_size'   => 'a4',
            ]));

        $responseA4->assertStatus(200);
        $responseA4->assertSee('2078873062');
        $responseA4->assertSee('2078873063');
        $responseA4->assertSee('এইটা সবার ফোনে সেভ করে রাখবেন');
        $responseA4->assertSee('size-a4');

        // Legal Print
        $responseLegal = $this->actingAs($this->adminUser)
            ->get(route('admin.bteb-omr.print', [
                'start_litho' => '2078873062',
                'count'       => 1,
                'mode'        => 'blank',
                'page_size'   => 'legal',
            ]));

        $responseLegal->assertStatus(200);
        $responseLegal->assertSee('size-legal');
    }

    /**
     * Test 4: AJAX Litho code auto-generation endpoint for admin
     */
    public function test_ajax_litho_code_generation()
    {
        $response = $this->actingAs($this->adminUser)
            ->postJson(route('admin.bteb-omr.generate'), [
                'action' => 'single',
                'prefix' => '20',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        $json = $response->json();
        $this->assertEquals(10, strlen($json['litho_code']));
        $this->assertStringStartsWith('20', $json['litho_code']);
    }

    /**
     * Test 5: Student route redirects to admin route
     */
    public function test_student_route_redirects_to_admin()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('student.omr.index'));

        $response->assertRedirect(route('admin.bteb-omr.index'));
    }

    /**
     * Test 6: Student panel menu tree DOES NOT include BTEB OMR Sheet item (admin only)
     */
    public function test_student_menu_tree_does_not_have_bteb_omr_sheet()
    {
        StudentMenuService::clearCache();
        $tree = StudentMenuService::getTree();
        
        $examMenu = $tree->firstWhere('menu_key', 'quiz_examination');
        $this->assertNotNull($examMenu);

        $omrMenu = $examMenu->activeChildren->firstWhere('menu_key', 'bteb_omr_sheet');
        $this->assertNull($omrMenu, 'BTEB OMR Sheet menu should NOT be in student menu tree; it is an admin-only tool');
    }
}
