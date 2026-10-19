<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SyncPortfolioAndCourseUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Sync National Works (Portfolio items 5 and 6)
        if (Schema::hasTable('national_works')) {
            // Project 1: WU-Stock ERP
            $exists1 = DB::table('national_works')->where('id', 5)->orWhere('blog_id', 51)->first();
            if ($exists1) {
                DB::table('national_works')->where('id', $exists1->id)->update([
                    'title' => 'Live Stock & Inventory Management System (WU-Stock ERP)',
                    'blog_id' => 51,
                    'image' => 'uploads/national_work/images/inventory_management_national.png',
                    'image_alt' => 'Live Stock and Inventory Management System',
                    'logo' => 'fa fa-cubes',
                    'description' => '<p>আধুনিক ক্লাউড ওয়্যারহাউস, পয়েন্ট অব সেল (POS) এবং রিয়েল-টাইম মাল্টি-ব্রাঞ্চ লাইভ স্টক ইনভেন্টরি ম্যানেজমেন্ট সলিউশন।</p>',
                    'active_project' => 1,
                    'status' => 1,
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('national_works')->insert([
                    'id' => 5,
                    'title' => 'Live Stock & Inventory Management System (WU-Stock ERP)',
                    'blog_id' => 51,
                    'image' => 'uploads/national_work/images/inventory_management_national.png',
                    'image_alt' => 'Live Stock and Inventory Management System',
                    'logo' => 'fa fa-cubes',
                    'description' => '<p>আধুনিক ক্লাউড ওয়্যারহাউস, পয়েন্ট অব সেল (POS) এবং রিয়েল-টাইম মাল্টি-ব্রাঞ্চ লাইভ স্টক ইনভেন্টরি ম্যানেজমেন্ট সলিউশন।</p>',
                    'active_project' => 1,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Project 2: Rent-A-Car & Fleet Management
            $exists2 = DB::table('national_works')->where('id', 6)->orWhere('blog_id', 15)->first();
            if ($exists2) {
                DB::table('national_works')->where('id', $exists2->id)->update([
                    'title' => 'Online Rent-A-Car & Fleet Trip Management System',
                    'blog_id' => 15,
                    'image' => 'uploads/national_work/images/rent_a_car_fleet_national.png',
                    'image_alt' => 'Online Rent-A-Car and Fleet Trip Management',
                    'logo' => 'fa fa-car',
                    'description' => '<p>রিয়েল-টাইম ভেহিকেল ট্র্যাকিং, অনলাইন ড্রাইভার ডিসপ্যাচ ও স্বয়ংক্রিয় ট্রিপ ও রেভিনিউ বিলিং সিস্টেম।</p>',
                    'active_project' => 1,
                    'status' => 1,
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('national_works')->insert([
                    'id' => 6,
                    'title' => 'Online Rent-A-Car & Fleet Trip Management System',
                    'blog_id' => 15,
                    'image' => 'uploads/national_work/images/rent_a_car_fleet_national.png',
                    'image_alt' => 'Online Rent-A-Car and Fleet Trip Management',
                    'logo' => 'fa fa-car',
                    'description' => '<p>রিয়েল-টাইম ভেহিকেল ট্র্যাকিং, অনলাইন ড্রাইভার ডিসপ্যাচ ও স্বয়ংক্রিয় ট্রিপ ও রেভিনিউ বিলিং সিস্টেম।</p>',
                    'active_project' => 1,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 2. Sync International Works (Item 11: Ibrahim Cardiac)
        if (Schema::hasTable('international_works')) {
            $exists3 = DB::table('international_works')->where('id', 11)->orWhere('blog_id', 53)->first();
            if ($exists3) {
                DB::table('international_works')->where('id', $exists3->id)->update([
                    'blog_id' => 53,
                    'image' => 'uploads/international_work/images/heartcop_ibrahim_international.jpg',
                    'image_alt' => 'Heart Cop in Ibrahim Cardiac Hospital & Research Institute',
                    'active_work' => 1,
                    'status' => 1,
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('international_works')->insert([
                    'id' => 11,
                    'blog_id' => 53,
                    'image' => 'uploads/international_work/images/heartcop_ibrahim_international.jpg',
                    'image_alt' => 'Heart Cop in Ibrahim Cardiac Hospital & Research Institute',
                    'active_work' => 1,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 3. Update Courses: Batch capacity = 10 persons for all, AI course fee = 1000, 1 Month
        if (Schema::hasTable('courses')) {
            DB::table('courses')->update(['student_quantity' => '১০ জন']);
            DB::table('courses')->where('id', 11)->update([
                'price' => '1000',
                'time_line' => '1 Month',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
