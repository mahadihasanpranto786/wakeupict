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
     * Test 2: Student can access BTEB OMR Sheet builder page
     */
    public function test_student_can_view_bteb_omr_sheet_builder()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.omr.index'));

        $response->assertStatus(200);
        $response->assertSee('বাংলাদেশ কারিগরি শিক্ষা বোর্ড');
        $response->assertSee('ওএমআর শিট ও লিথু কোড বিল্ডার');
        $response->assertSee('রেজিস্ট্রেশন নম্বর');
        $response->assertSee('কারিকুলাম');
        $response->assertSee('রেজিস্ট্রেশন নম্বর নিজেরটা লিখবেন। (ডানদিক থেকে লিখবেন)');
        $response->assertSee('রোল নম্বর');
        $response->assertSee('omr-header-cell');
        $response->assertSee('bubble-filled');
    }

    /**
     * Test 3: Standalone clean print view with batch multi-page support
     */
    public function test_bteb_omr_sheet_batch_print_view()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.omr.print', [
                'start_litho' => '2078873062',
                'count'       => 2,
                'mode'        => 'guide',
            ]));

        $response->assertStatus(200);
        $response->assertSee('2078873062');
        $response->assertSee('2078873063');
        $response->assertSee('এইটা সবার ফোনে সেভ করে রাখবেন');
    }

    /**
     * Test 4: AJAX Litho code auto-generation endpoint
     */
    public function test_ajax_litho_code_generation()
    {
        $response = $this->actingAs($this->student, 'student')
            ->postJson(route('student.omr.generate'), [
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
     * Test 5: Admin can access BTEB OMR Sheet Builder
     */
    public function test_admin_can_access_bteb_omr_sheet()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.bteb-omr.index'));

        $response->assertStatus(200);
        $response->assertSee('বাংলাদেশ কারিগরি শিক্ষা বোর্ড');
    }

    /**
     * Test 6: Student panel menu includes BTEB OMR Sheet item
     */
    public function test_student_menu_tree_has_bteb_omr_sheet()
    {
        StudentMenuService::clearCache();
        $tree = StudentMenuService::getTree();
        
        $examMenu = $tree->firstWhere('menu_key', 'quiz_examination');
        $this->assertNotNull($examMenu);

        $omrMenu = $examMenu->activeChildren->firstWhere('menu_key', 'bteb_omr_sheet');
        $this->assertNotNull($omrMenu, 'BTEB OMR Sheet menu should be in student menu tree under quiz_examination');
        $this->assertEquals(route('student.omr.index'), $omrMenu->resolveUrl());
    }
}
