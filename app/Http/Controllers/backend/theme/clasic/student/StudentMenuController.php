<?php

namespace App\Http\Controllers\backend\theme\clasic\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\StudentPanelMenu;
use App\Services\StudentMenuService;

class StudentMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all student panel menus for administrative management
     */
    public function index()
    {
        // Auto-seed defaults if table is empty
        if (StudentPanelMenu::count() === 0) {
            StudentMenuService::resetDefaults();
        }

        $menus = StudentPanelMenu::parents()
            ->with(['children'])
            ->orderBy('order_index', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $allParents = StudentPanelMenu::parents()->get();

        $availableRoutes = [
            'student.dashboard' => [
                'name' => 'student.dashboard',
                'label' => 'Dashboard (ড্যাশবোর্ড)',
                'title_en' => 'Dashboard',
                'title_bn' => 'ড্যাশবোর্ড',
                'icon' => 'fa fa-dashboard',
            ],
            'student.courses.my' => [
                'name' => 'student.courses.my',
                'label' => 'My Courses (আমার কোর্সসমূহ)',
                'title_en' => 'My Courses',
                'title_bn' => 'আমার কোর্সসমূহ',
                'icon' => 'fa fa-book',
            ],
            'student.courses.browse' => [
                'name' => 'student.courses.browse',
                'label' => 'Browse Courses (সকল কোর্সসমূহ)',
                'title_en' => 'Browse Courses',
                'title_bn' => 'সকল কোর্সসমূহ',
                'icon' => 'fa fa-search',
            ],
            'student.materials.index' => [
                'name' => 'student.materials.index',
                'label' => 'Learning Materials (শিক্ষা উপকরণ)',
                'title_en' => 'Learning Materials',
                'title_bn' => 'শিক্ষা উপকরণ',
                'icon' => 'fa fa-download',
            ],
            'student.progress.index' => [
                'name' => 'student.progress.index',
                'label' => 'Course Progress (কোর্স অগ্রগতি)',
                'title_en' => 'Course Progress',
                'title_bn' => 'কোর্স অগ্রগতি',
                'icon' => 'fa fa-line-chart',
            ],
            'student.schedule.index' => [
                'name' => 'student.schedule.index',
                'label' => 'Class Schedule (ক্লাসের সময়সূচী)',
                'title_en' => 'Class Schedule',
                'title_bn' => 'ক্লাসের সময়সূচী',
                'icon' => 'fa fa-calendar',
            ],
            'student.attendance.index' => [
                'name' => 'student.attendance.index',
                'label' => 'Attendance History (উপস্থিতির ইতিহাস)',
                'title_en' => 'Attendance History',
                'title_bn' => 'উপস্থিতির ইতিহাস',
                'icon' => 'fa fa-calendar-check-o',
            ],
            'student.live.index' => [
                'name' => 'student.live.index',
                'label' => 'Live Classes (লাইভ ক্লাস)',
                'title_en' => 'Live Classes',
                'title_bn' => 'লাইভ ক্লাস',
                'icon' => 'fa fa-video-camera',
            ],
            'student.recorded.index' => [
                'name' => 'student.recorded.index',
                'label' => 'Recorded Classes (রেকর্ডকৃত ক্লাস)',
                'title_en' => 'Recorded Classes',
                'title_bn' => 'রেকর্ডকৃত ক্লাস',
                'icon' => 'fa fa-play-circle',
            ],
            'student.exams.upcoming' => [
                'name' => 'student.exams.upcoming',
                'label' => 'Upcoming Exams (আসন্ন পরীক্ষা)',
                'title_en' => 'Upcoming Exams',
                'title_bn' => 'আসন্ন পরীক্ষা',
                'icon' => 'fa fa-clock-o',
            ],
            'student.quiz.index' => [
                'name' => 'student.quiz.index',
                'label' => 'Online Quiz (অনলাইন কুইজ)',
                'title_en' => 'Online Quiz',
                'title_bn' => 'অনলাইন কুইজ',
                'icon' => 'fa fa-question-circle',
            ],
            'student.practice.index' => [
                'name' => 'student.practice.index',
                'label' => 'Practice Tests (অনুশীলন পরীক্ষা)',
                'title_en' => 'Practice Tests',
                'title_bn' => 'অনুশীলন পরীক্ষা',
                'icon' => 'fa fa-check-square-o',
            ],
            'student.results.index' => [
                'name' => 'student.results.index',
                'label' => 'Results & Transcripts (ফলাফল)',
                'title_en' => 'Results & Transcripts',
                'title_bn' => 'ফলাফল',
                'icon' => 'fa fa-bar-chart',
            ],
            'student.exams.history' => [
                'name' => 'student.exams.history',
                'label' => 'Exam History (পরীক্ষার ইতিহাস)',
                'title_en' => 'Exam History',
                'title_bn' => 'পরীক্ষার ইতিহাস',
                'icon' => 'fa fa-history',
            ],
            'student.assignments.index' => [
                'name' => 'student.assignments.index',
                'label' => 'My Assignments (আমার অ্যাসাইনমেন্ট)',
                'title_en' => 'My Assignments',
                'title_bn' => 'আমার অ্যাসাইনমেন্ট',
                'icon' => 'fa fa-tasks',
            ],
            'student.assignments.submit' => [
                'name' => 'student.assignments.submit',
                'label' => 'Submit Assignment (অ্যাসাইনমেন্ট জমা দিন)',
                'title_en' => 'Submit Assignment',
                'title_bn' => 'অ্যাসাইনমেন্ট জমা দিন',
                'icon' => 'fa fa-upload',
            ],
            'student.projects.index' => [
                'name' => 'student.projects.index',
                'label' => 'Project Submissions (প্রজেক্ট সাবমিশন)',
                'title_en' => 'Project Submissions',
                'title_bn' => 'প্রজেক্ট সাবমিশন',
                'icon' => 'fa fa-folder-open',
            ],
            'student.assignments.feedback' => [
                'name' => 'student.assignments.feedback',
                'label' => 'Teacher Feedback (শিক্ষকের মন্তব্য)',
                'title_en' => 'Teacher Feedback',
                'title_bn' => 'শিক্ষকের মন্তব্য',
                'icon' => 'fa fa-commenting-o',
            ],
            'student.fees.index' => [
                'name' => 'student.fees.index',
                'label' => 'Course Fees (কোর্সের ফি)',
                'title_en' => 'Course Fees',
                'title_bn' => 'কোর্সের ফি',
                'icon' => 'fa fa-money',
            ],
            'student.payments.history' => [
                'name' => 'student.payments.history',
                'label' => 'Payment History (পেমেন্টের ইতিহাস)',
                'title_en' => 'Payment History',
                'title_bn' => 'পেমেন্টের ইতিহাস',
                'icon' => 'fa fa-credit-card',
            ],
            'student.dues.index' => [
                'name' => 'student.dues.index',
                'label' => 'Outstanding Dues (বকেয়া ফি)',
                'title_en' => 'Outstanding Dues',
                'title_bn' => 'বকেয়া ফি',
                'icon' => 'fa fa-exclamation-circle',
            ],
            'student.receipts.index' => [
                'name' => 'student.receipts.index',
                'label' => 'Payment Receipts (রশিদ ও ভাউচার)',
                'title_en' => 'Payment Receipts',
                'title_bn' => 'রশিদ ও ভাউচার',
                'icon' => 'fa fa-file-text-o',
            ],
            'student.certificates.index' => [
                'name' => 'student.certificates.index',
                'label' => 'Certificates & Achievements (সনদপত্র ও অর্জন)',
                'title_en' => 'Certificates & Achievements',
                'title_bn' => 'সনদপত্র ও অর্জন',
                'icon' => 'fa fa-trophy',
            ],
            'student.notifications.index' => [
                'name' => 'student.notifications.index',
                'label' => 'Notifications & Announcements (নোটিশ ও ঘোষণা)',
                'title_en' => 'Notifications & Announcements',
                'title_bn' => 'নোটিশ ও ঘোষণা',
                'icon' => 'fa fa-bell',
            ],
            'student.support.index' => [
                'name' => 'student.support.index',
                'label' => 'Support & Communication (সহায়তা ও যোগাযোগ)',
                'title_en' => 'Support & Communication',
                'title_bn' => 'সহায়তা ও যোগাযোগ',
                'icon' => 'fa fa-life-ring',
            ],
            'student.profile.index' => [
                'name' => 'student.profile.index',
                'label' => 'My Profile & Settings (প্রোফাইল ও সেটিংস)',
                'title_en' => 'My Profile & Settings',
                'title_bn' => 'প্রোফাইল ও সেটিংস',
                'icon' => 'fa fa-user-circle',
            ],
        ];

        return view('backend.theme.clasic.student.menu.index', compact('menus', 'allParents', 'availableRoutes'));
    }

    /**
     * Store a new custom menu item
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu_key' => 'required|string|max:100|unique:student_panel_menus,menu_key',
            'title_en' => 'required|string|max:191',
            'title_bn' => 'required|string|max:191',
            'icon' => 'required|string|max:100',
            'parent_id' => 'nullable|integer',
            'order_index' => 'nullable|integer',
            'route_name' => 'nullable|string|max:191',
            'url' => 'nullable|string|max:191',
        ]);

        StudentPanelMenu::create([
            'menu_key' => str_slug($request->menu_key, '_'),
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'icon' => $request->icon,
            'parent_id' => $request->parent_id ?: 0,
            'order_index' => $request->order_index ?: 0,
            'route_name' => $request->route_name ?: null,
            'url' => $request->url ?: null,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        StudentMenuService::clearCache();

        return redirect()->route('admin.student-menus.index')->with([
            'success' => 'Menu item created successfully.',
        ]);
    }

    /**
     * Update an existing menu item
     */
    public function update(Request $request, $id)
    {
        $menu = StudentPanelMenu::findOrFail($id);

        $request->validate([
            'title_en' => 'required|string|max:191',
            'title_bn' => 'required|string|max:191',
            'icon' => 'required|string|max:100',
            'parent_id' => 'nullable|integer',
            'order_index' => 'required|integer',
            'route_name' => 'nullable|string|max:191',
            'url' => 'nullable|string|max:191',
        ]);

        $menu->update([
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'icon' => $request->icon,
            'parent_id' => $request->parent_id ?: 0,
            'order_index' => $request->order_index,
            'route_name' => $request->route_name ?: null,
            'url' => $request->url ?: null,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        StudentMenuService::clearCache();

        return redirect()->route('admin.student-menus.index')->with([
            'success' => 'Menu item updated successfully.',
        ]);
    }

    /**
     * Quick toggle active status
     */
    public function toggle($id)
    {
        $menu = StudentPanelMenu::findOrFail($id);
        $menu->is_active = !$menu->is_active;
        $menu->save();

        StudentMenuService::clearCache();

        return response()->json([
            'status' => 'success',
            'is_active' => $menu->is_active,
            'message' => 'Status updated successfully.',
        ]);
    }

    /**
     * Move menu item up or down among siblings
     */
    public function move($id, $direction)
    {
        $menu = StudentPanelMenu::findOrFail($id);
        $parentId = $menu->parent_id ?: 0;

        $siblings = StudentPanelMenu::where(function ($q) use ($parentId) {
                if ($parentId == 0) {
                    $q->where('parent_id', 0)->orWhereNull('parent_id');
                } else {
                    $q->where('parent_id', $parentId);
                }
            })
            ->orderBy('order_index', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $currentIndex = $siblings->search(function ($item) use ($menu) {
            return $item->id == $menu->id;
        });

        if ($currentIndex !== false) {
            if ($direction === 'up' && $currentIndex > 0) {
                $prev = $siblings[$currentIndex - 1];
                $tempOrder = $prev->order_index;
                $prev->order_index = $menu->order_index;
                $menu->order_index = $tempOrder;
                if ($prev->order_index == $menu->order_index) {
                    $menu->order_index = max(1, $prev->order_index - 1);
                }
                $prev->save();
                $menu->save();
            } elseif ($direction === 'down' && $currentIndex < $siblings->count() - 1) {
                $next = $siblings[$currentIndex + 1];
                $tempOrder = $next->order_index;
                $next->order_index = $menu->order_index;
                $menu->order_index = $tempOrder;
                if ($next->order_index == $menu->order_index) {
                    $menu->order_index = $next->order_index + 1;
                }
                $next->save();
                $menu->save();
            }
        }

        StudentMenuService::clearCache();

        return redirect()->route('admin.student-menus.index')->with([
            'success' => 'Menu order updated successfully.',
        ]);
    }

    /**
     * Reset menus to factory defaults
     */
    public function resetDefaults()
    {
        StudentMenuService::resetDefaults();

        return redirect()->route('admin.student-menus.index')->with([
            'success' => 'All Student Panel menus have been reset to factory defaults.',
        ]);
    }

    /**
     * Delete a menu item
     */
    public function destroy($id)
    {
        $menu = StudentPanelMenu::findOrFail($id);
        // Also delete submenus if any
        StudentPanelMenu::where('parent_id', $menu->id)->delete();
        $menu->delete();

        StudentMenuService::clearCache();

        return redirect()->route('admin.student-menus.index')->with([
            'success' => 'Menu item removed successfully.',
        ]);
    }
}
