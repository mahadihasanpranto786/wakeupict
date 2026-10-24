<?php

namespace App\Services;

use App\model\StudentPanelMenu;
use Illuminate\Support\Facades\Cache;

class StudentMenuService
{
    const CACHE_KEY = 'student_panel_menu_tree';
    const CACHE_TTL = 3600;

    /**
     * Get active hierarchical menu tree for Student Panel
     */
    public static function getTree()
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            // If table is empty, auto-seed defaults
            if (StudentPanelMenu::count() === 0) {
                self::resetDefaults();
            }

            return StudentPanelMenu::parents()
                ->where('is_active', true)
                ->with(['activeChildren'])
                ->orderBy('order_index', 'asc')
                ->orderBy('id', 'asc')
                ->get();
        });
    }

    /**
     * Clear menu cache
     */
    public static function clearCache()
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Check if a feature is active
     */
    public static function isFeatureEnabled($menuKey)
    {
        $item = StudentPanelMenu::where('menu_key', $menuKey)->first();
        if (!$item) {
            return true; // Default open if not strictly managed
        }
        return (bool) $item->is_active;
    }

    /**
     * Reset and seed the default menu configuration
     */
    public static function resetDefaults()
    {
        StudentPanelMenu::truncate();

        $defaults = [
            [
                'menu_key' => 'dashboard',
                'title_en' => 'Dashboard',
                'title_bn' => 'ড্যাশবোর্ড',
                'route_name' => 'student.dashboard',
                'icon' => 'fa fa-th-large',
                'order_index' => 1,
                'is_active' => true,
                'children' => [],
            ],
            [
                'menu_key' => 'my_learning',
                'title_en' => 'My Learning',
                'title_bn' => 'আমার শিক্ষা',
                'route_name' => null,
                'icon' => 'fa fa-graduation-cap',
                'order_index' => 2,
                'is_active' => true,
                'children' => [
                    [
                        'menu_key' => 'my_courses',
                        'title_en' => 'My Courses',
                        'title_bn' => 'আমার কোর্সসমূহ',
                        'route_name' => 'student.courses.my',
                        'icon' => 'fa fa-book',
                        'order_index' => 1,
                    ],
                    [
                        'menu_key' => 'browse_courses',
                        'title_en' => 'Browse Courses',
                        'title_bn' => 'সকল কোর্সসমূহ',
                        'route_name' => 'student.courses.browse',
                        'icon' => 'fa fa-search',
                        'order_index' => 2,
                    ],
                    [
                        'menu_key' => 'learning_materials',
                        'title_en' => 'Learning Materials',
                        'title_bn' => 'শিক্ষা উপকরণ',
                        'route_name' => 'student.materials.index',
                        'icon' => 'fa fa-file-text-o',
                        'order_index' => 3,
                    ],
                    [
                        'menu_key' => 'course_progress',
                        'title_en' => 'Course Progress',
                        'title_bn' => 'কোর্স অগ্রগতি',
                        'route_name' => 'student.progress.index',
                        'icon' => 'fa fa-line-chart',
                        'order_index' => 4,
                    ],
                ],
            ],
            [
                'menu_key' => 'classes_attendance',
                'title_en' => 'Classes & Attendance',
                'title_bn' => 'ক্লাস ও উপস্থিতি',
                'route_name' => null,
                'icon' => 'fa fa-calendar-check-o',
                'order_index' => 3,
                'is_active' => true,
                'children' => [
                    [
                        'menu_key' => 'class_schedule',
                        'title_en' => 'Class Schedule',
                        'title_bn' => 'ক্লাসের সময়সূচী',
                        'route_name' => 'student.schedule.index',
                        'icon' => 'fa fa-calendar',
                        'order_index' => 1,
                    ],
                    [
                        'menu_key' => 'attendance_history',
                        'title_en' => 'Attendance History',
                        'title_bn' => 'উপস্থিতির ইতিহাস',
                        'route_name' => 'student.attendance.index',
                        'icon' => 'fa fa-check-square-o',
                        'order_index' => 2,
                    ],
                    [
                        'menu_key' => 'live_classes',
                        'title_en' => 'Live Classes',
                        'title_bn' => 'লাইভ ক্লাস',
                        'route_name' => 'student.live.index',
                        'icon' => 'fa fa-video-camera',
                        'order_index' => 3,
                    ],
                    [
                        'menu_key' => 'recorded_classes',
                        'title_en' => 'Recorded Classes',
                        'title_bn' => 'রেকর্ডকৃত ক্লাস',
                        'route_name' => 'student.recorded.index',
                        'icon' => 'fa fa-play-circle',
                        'order_index' => 4,
                    ],
                ],
            ],
            [
                'menu_key' => 'quiz_examination',
                'title_en' => 'Quiz & Examination',
                'title_bn' => 'কুইজ ও পরীক্ষা',
                'route_name' => null,
                'icon' => 'fa fa-question-circle',
                'order_index' => 4,
                'is_active' => true,
                'children' => [
                    [
                        'menu_key' => 'upcoming_exams',
                        'title_en' => 'Upcoming Exams',
                        'title_bn' => 'আসন্ন পরীক্ষা',
                        'route_name' => 'student.exams.upcoming',
                        'icon' => 'fa fa-clock-o',
                        'order_index' => 1,
                    ],
                    [
                        'menu_key' => 'online_quiz',
                        'title_en' => 'Online Quiz',
                        'title_bn' => 'অনলাইন কুইজ',
                        'route_name' => 'student.quiz.index',
                        'icon' => 'fa fa-pencil-square-o',
                        'order_index' => 2,
                    ],
                    [
                        'menu_key' => 'practice_tests',
                        'title_en' => 'Practice Tests',
                        'title_bn' => 'অনুশীলন পরীক্ষা',
                        'route_name' => 'student.practice.index',
                        'icon' => 'fa fa-flask',
                        'order_index' => 3,
                    ],
                    [
                        'menu_key' => 'results',
                        'title_en' => 'Results',
                        'title_bn' => 'ফলাফল',
                        'route_name' => 'student.results.index',
                        'icon' => 'fa fa-trophy',
                        'order_index' => 4,
                    ],
                    [
                        'menu_key' => 'exam_history',
                        'title_en' => 'Exam History',
                        'title_bn' => 'পরীক্ষার ইতিহাস',
                        'route_name' => 'student.exams.history',
                        'icon' => 'fa fa-history',
                        'order_index' => 5,
                    ],
                    [
                        'menu_key' => 'bteb_omr_sheet',
                        'title_en' => 'BTEB OMR & Litho Sheet',
                        'title_bn' => 'বিটিইবি ওএমআর ও লিথু কোড',
                        'route_name' => 'student.omr.index',
                        'icon' => 'fa fa-id-card-o',
                        'order_index' => 6,
                    ],
                ],
            ],
            [
                'menu_key' => 'assignments_projects',
                'title_en' => 'Assignments & Projects',
                'title_bn' => 'অ্যাসাইনমেন্ট ও প্রজেক্ট',
                'route_name' => null,
                'icon' => 'fa fa-tasks',
                'order_index' => 5,
                'is_active' => true,
                'children' => [
                    [
                        'menu_key' => 'my_assignments',
                        'title_en' => 'My Assignments',
                        'title_bn' => 'আমার অ্যাসাইনমেন্ট',
                        'route_name' => 'student.assignments.index',
                        'icon' => 'fa fa-clipboard',
                        'order_index' => 1,
                    ],
                    [
                        'menu_key' => 'submit_assignment',
                        'title_en' => 'Submit Assignment',
                        'title_bn' => 'অ্যাসাইনমেন্ট জমা দিন',
                        'route_name' => 'student.assignments.submit',
                        'icon' => 'fa fa-upload',
                        'order_index' => 2,
                    ],
                    [
                        'menu_key' => 'project_submissions',
                        'title_en' => 'Project Submissions',
                        'title_bn' => 'প্রজেক্ট সাবমিশন',
                        'route_name' => 'student.projects.index',
                        'icon' => 'fa fa-folder-open-o',
                        'order_index' => 3,
                    ],
                    [
                        'menu_key' => 'teacher_feedback',
                        'title_en' => 'Teacher Feedback',
                        'title_bn' => 'শিক্ষকের মন্তব্য',
                        'route_name' => 'student.assignments.feedback',
                        'icon' => 'fa fa-commenting-o',
                        'order_index' => 4,
                    ],
                ],
            ],
            [
                'menu_key' => 'fees_payments',
                'title_en' => 'Fees & Payments',
                'title_bn' => 'ফি ও পেমেন্ট',
                'route_name' => null,
                'icon' => 'fa fa-credit-card',
                'order_index' => 6,
                'is_active' => true,
                'children' => [
                    [
                        'menu_key' => 'course_fees',
                        'title_en' => 'Course Fees',
                        'title_bn' => 'কোর্সের ফি',
                        'route_name' => 'student.fees.index',
                        'icon' => 'fa fa-money',
                        'order_index' => 1,
                    ],
                    [
                        'menu_key' => 'payment_history',
                        'title_en' => 'Payment History',
                        'title_bn' => 'পেমেন্টের ইতিহাস',
                        'route_name' => 'student.payments.history',
                        'icon' => 'fa fa-file-text',
                        'order_index' => 2,
                    ],
                    [
                        'menu_key' => 'outstanding_dues',
                        'title_en' => 'Outstanding Dues',
                        'title_bn' => 'বকেয়া ফি',
                        'route_name' => 'student.dues.index',
                        'icon' => 'fa fa-exclamation-circle',
                        'order_index' => 3,
                    ],
                    [
                        'menu_key' => 'receipts',
                        'title_en' => 'Receipts',
                        'title_bn' => 'রশিদ ও ভাউচার',
                        'route_name' => 'student.receipts.index',
                        'icon' => 'fa fa-print',
                        'order_index' => 4,
                    ],
                ],
            ],
            [
                'menu_key' => 'certificates_achievements',
                'title_en' => 'Certificates & Achievements',
                'title_bn' => 'সনদপত্র ও অর্জন',
                'route_name' => 'student.certificates.index',
                'icon' => 'fa fa-certificate',
                'order_index' => 7,
                'is_active' => true,
                'children' => [],
            ],
            [
                'menu_key' => 'notifications_announcements',
                'title_en' => 'Notifications & Announcements',
                'title_bn' => 'নোটিশ ও ঘোষণা',
                'route_name' => 'student.notifications.index',
                'icon' => 'fa fa-bell-o',
                'order_index' => 8,
                'is_active' => true,
                'children' => [],
            ],
            [
                'menu_key' => 'support_communication',
                'title_en' => 'Support & Communication',
                'title_bn' => 'সহায়তা ও যোগাযোগ',
                'route_name' => 'student.support.index',
                'icon' => 'fa fa-life-ring',
                'order_index' => 9,
                'is_active' => true,
                'children' => [],
            ],
            [
                'menu_key' => 'profile_settings',
                'title_en' => 'My Profile & Settings',
                'title_bn' => 'প্রোফাইল ও সেটিংস',
                'route_name' => 'student.profile.index',
                'icon' => 'fa fa-user-circle-o',
                'order_index' => 10,
                'is_active' => true,
                'children' => [],
            ],
        ];

        foreach ($defaults as $parentData) {
            $children = $parentData['children'];
            unset($parentData['children']);

            $parent = StudentPanelMenu::create($parentData);

            foreach ($children as $childData) {
                $childData['parent_id'] = $parent->id;
                $childData['is_active'] = true;
                StudentPanelMenu::create($childData);
            }
        }

        self::clearCache();
    }
}
