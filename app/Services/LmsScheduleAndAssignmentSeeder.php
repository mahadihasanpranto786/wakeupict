<?php

namespace App\Services;

use App\model\Course;
use App\model\Batch;
use App\model\LmsClassSchedule;
use App\model\LmsAttendance;
use App\model\LmsAssignment;
use Carbon\Carbon;

class LmsScheduleAndAssignmentSeeder
{
    public static function seedSchedulesAndAssignments()
    {
        $today = Carbon::today();
        $batch = Batch::first();
        $batchId = $batch ? $batch->id : null;

        // 1. Web Development Course (ID 3)
        $webCourse = Course::where('id', 3)->orWhere('course_slug', 'LIKE', '%web-design%')->first();
        if ($webCourse && LmsClassSchedule::where('course_id', $webCourse->id)->count() === 0) {
            // Live class tomorrow
            LmsClassSchedule::create([
                'course_id' => $webCourse->id,
                'batch_id' => $batchId,
                'title' => 'Live Lab: Responsive Architecture & Modern Flexbox Layouts',
                'description' => 'Hands-on live coding workshop covering mobile-first responsive breakpoints and UI component styling.',
                'class_type' => 'live_online',
                'meeting_platform' => 'zoom',
                'meeting_link' => 'https://zoom.us/j/9876543210?pwd=WUICT',
                'meeting_id' => '987 654 3210',
                'meeting_password' => 'WUICT2026',
                'class_date' => $today->copy()->addDay(),
                'start_time' => '19:00:00',
                'end_time' => '21:00:00',
            ]);

            // Recorded class from yesterday
            LmsClassSchedule::create([
                'course_id' => $webCourse->id,
                'batch_id' => $batchId,
                'title' => 'Recorded Lecture: Client-Server Architecture & DOM Manipulation',
                'description' => 'Detailed lecture recording on HTTP lifecycle, event listeners, and dynamic DOM rendering.',
                'class_type' => 'recorded',
                'meeting_platform' => 'custom',
                'recording_url' => 'https://www.youtube.com/watch?v=UB1O30fR-EE',
                'class_date' => $today->copy()->subDays(2),
                'start_time' => '19:00:00',
                'end_time' => '21:00:00',
            ]);

            // Web Assignment & Term Project
            LmsAssignment::create([
                'course_id' => $webCourse->id,
                'batch_id' => $batchId,
                'title' => 'Project 1: Modern Corporate Responsive Landing Page',
                'description' => "### Assignment Requirements:\n1. Build a responsive 5-section landing page using HTML5 and CSS3.\n2. Ensure zero horizontal scroll on mobile devices (320px+).\n3. Include a functional contact form with client-side validation.\n4. Submit your source files as a ZIP archive or host on GitHub Pages.",
                'assignment_type' => 'project',
                'total_marks' => 100,
                'pass_marks' => 50,
                'due_date' => Carbon::now()->addDays(14),
                'allowed_file_types' => 'zip,pdf',
                'max_file_size_mb' => 25,
                'is_published' => true,
            ]);
        }

        // 2. Graphic Design Course (ID 1)
        $graphicCourse = Course::where('id', 1)->orWhere('course_slug', 'LIKE', '%graphic%')->first();
        if ($graphicCourse && LmsClassSchedule::where('course_id', $graphicCourse->id)->count() === 0) {
            LmsClassSchedule::create([
                'course_id' => $graphicCourse->id,
                'batch_id' => $batchId,
                'title' => 'Offline Practical Lab: Vector Art & Brand Identity in Adobe Illustrator',
                'description' => 'In-person lab session at Wake Up ICT Campus. Designing professional vector logos and typography guidelines.',
                'class_type' => 'offline_lab',
                'meeting_platform' => 'lab_room',
                'room_number' => 'Lab 102 (Main Campus)',
                'class_date' => $today->copy()->addDays(2),
                'start_time' => '10:00:00',
                'end_time' => '12:30:00',
            ]);

            LmsAssignment::create([
                'course_id' => $graphicCourse->id,
                'batch_id' => $batchId,
                'title' => 'Assignment: Minimalist Brand Identity & Logo Suite',
                'description' => "Create an original logo symbol with color variations (Light/Dark/Monochrome) and mockup on a business card. Export final deliverables in high-resolution PDF.",
                'assignment_type' => 'assignment',
                'total_marks' => 50,
                'pass_marks' => 25,
                'due_date' => Carbon::now()->addDays(10),
                'allowed_file_types' => 'pdf,png,jpg,zip',
                'max_file_size_mb' => 20,
                'is_published' => true,
            ]);
        }

        // 3. Academic ICT (Classes 6-10)
        $academicCourse = Course::where('course_slug', 'academic-ict-classes-6-10')->first();
        if ($academicCourse && LmsClassSchedule::where('course_id', $academicCourse->id)->count() === 0) {
            LmsClassSchedule::create([
                'course_id' => $academicCourse->id,
                'batch_id' => $batchId,
                'title' => 'লাইভ ক্লাস: ৯ম ও ১০ম শ্রেণি আইসিটি বোর্ড প্রশ্ন ও প্র্যাকটিক্যাল সমাধান',
                'description' => 'জাতীয় শিক্ষাক্রমের ৩য় ও ৪র্থ অধ্যায়: স্প্রেডশিট বিশ্লেষণ, ডেটাবেজ রিলেশন এবং সাইবার সিকিউরিটি আইন সংক্রান্ত বোর্ড প্রশ্নাবলি সরাসরি সমাধান।',
                'class_type' => 'live_online',
                'meeting_platform' => 'google_meet',
                'meeting_link' => 'https://meet.google.com/abc-defg-hij',
                'class_date' => $today->copy()->addDays(3),
                'start_time' => '16:00:00',
                'end_time' => '17:30:00',
            ]);

            LmsAssignment::create([
                'course_id' => $academicCourse->id,
                'batch_id' => $batchId,
                'title' => 'ব্যবহারিক অ্যাসাইনমেন্ট: এক্সেল রেজাল্ট শিট ও গ্রেডিং ফর্মুলা',
                'description' => "এনসিটিবি পাঠ্যবই অনুসারে ১০ জন শিক্ষার্থীর ৫টি বিষয়ের নম্বর নিয়ে একটি এক্সেল শিট তৈরি করুন। SUM, AVERAGE এবং IF ফর্মুলা ব্যবহার করে গ্রেড নির্ণয় করে ফাইল জমা দিন।",
                'assignment_type' => 'homework',
                'total_marks' => 30,
                'pass_marks' => 15,
                'due_date' => Carbon::now()->addDays(7),
                'allowed_file_types' => 'xlsx,xls,pdf,docx',
                'max_file_size_mb' => 15,
                'is_published' => true,
            ]);
        }

        // 4. Artificial Intelligence Course
        $aiCourse = Course::where('course_slug', 'artificial-intelligence-course-rajbari')->first();
        if ($aiCourse && LmsClassSchedule::where('course_id', $aiCourse->id)->count() === 0) {
            LmsClassSchedule::create([
                'course_id' => $aiCourse->id,
                'batch_id' => $batchId,
                'title' => 'Live Masterclass: Generative AI Workflows & Prompt Engineering',
                'description' => 'Advanced session on few-shot prompting, structured system personas, and automating daily productivity with LLMs.',
                'class_type' => 'live_online',
                'meeting_platform' => 'zoom',
                'meeting_link' => 'https://zoom.us/j/1234567890?pwd=AI',
                'meeting_id' => '123 456 7890',
                'meeting_password' => 'AI2026',
                'class_date' => $today->copy()->addDays(4),
                'start_time' => '20:00:00',
                'end_time' => '22:00:00',
            ]);

            LmsAssignment::create([
                'course_id' => $aiCourse->id,
                'batch_id' => $batchId,
                'title' => 'AI Prompt Engineering Lab: Multi-Step Automation Template',
                'description' => "Design an end-to-end prompt workflow that analyzes raw data and generates a structured executive briefing. Submit test prompts and sample outputs as PDF.",
                'assignment_type' => 'assignment',
                'total_marks' => 50,
                'pass_marks' => 25,
                'due_date' => Carbon::now()->addDays(8),
                'allowed_file_types' => 'pdf,docx',
                'max_file_size_mb' => 10,
                'is_published' => true,
            ]);
        }
    }
}
