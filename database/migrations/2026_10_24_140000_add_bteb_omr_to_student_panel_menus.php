<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\model\StudentPanelMenu;
use App\Services\StudentMenuService;

class AddBtebOmrToStudentPanelMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('student_panel_menus')) {
            $parent = StudentPanelMenu::where('menu_key', 'quiz_examination')->first();
            
            if ($parent) {
                $exists = StudentPanelMenu::where('menu_key', 'bteb_omr_sheet')->first();
                if (!$exists) {
                    StudentPanelMenu::create([
                        'parent_id'   => $parent->id,
                        'menu_key'    => 'bteb_omr_sheet',
                        'title_en'    => 'BTEB OMR & Litho Sheet',
                        'title_bn'    => 'বিটিইবি ওএমআর ও লিথু কোড',
                        'route_name'  => 'student.omr.index',
                        'icon'        => 'fa fa-id-card-o',
                        'order_index' => 6,
                        'is_active'   => true,
                    ]);
                }
            }

            StudentMenuService::clearCache();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('student_panel_menus')) {
            StudentPanelMenu::where('menu_key', 'bteb_omr_sheet')->delete();
            StudentMenuService::clearCache();
        }
    }
}
