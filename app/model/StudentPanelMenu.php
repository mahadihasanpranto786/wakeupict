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
     * Resolve the quiz type for the current request if on a quiz/attempt route
     *
     * @return string|false Quiz type ('practice', 'regular', etc.) or false if not on quiz/attempt
     */
    public static function resolveCurrentQuizType()
    {
        $req = request();
        if (!$req) {
            return false;
        }

        if ($req->attributes->has('_resolved_quiz_type')) {
            return $req->attributes->get('_resolved_quiz_type');
        }

        $type = false;

        try {
            // 1. Check attemptId parameter or path regex on attempt routes (take, results, submit, etc.)
            $attemptId = $req->route('attemptId') ?: $req->route('attempt');
            if (!$attemptId && preg_match('#quiz/attempt/([0-9]+)#', $req->path(), $m)) {
                $attemptId = $m[1];
            }

            if ($attemptId) {
                $attempt = \App\model\LmsQuizAttempt::select('id', 'quiz_id')
                    ->with(['quiz:id,quiz_type'])
                    ->find($attemptId);
                if ($attempt && $attempt->quiz) {
                    $type = $attempt->quiz->quiz_type ?: 'regular';
                }
            }

            // 2. Check quizId on lobby or quiz routes
            if (!$type) {
                $quizId = $req->route('id') ?: $req->route('quiz');
                if (!$quizId && preg_match('#student/quiz/([0-9]+)#', $req->path(), $mq)) {
                    $quizId = $mq[1];
                }

                if ($quizId && ($req->routeIs('student.quiz.*') || $req->is('student/quiz/*'))) {
                    $quiz = \App\model\LmsQuiz::select('id', 'quiz_type')->find($quizId);
                    if ($quiz) {
                        $type = $quiz->quiz_type ?: 'regular';
                    }
                }
            }
        } catch (\Throwable $e) {
            // Silent fallback
        }

        $req->attributes->set('_resolved_quiz_type', $type);
        return $type;
    }

    /**
     * Check if current route or URL is active, including all child/detail pages
     */
    public function isCurrent()
    {
        $currentQuizType = static::resolveCurrentQuizType();

        // 1. Practice Tests (including live exam rooms and result details of practice attempts)
        if ($this->menu_key === 'practice_tests' || $this->route_name === 'student.practice.index') {
            if (request()->routeIs('student.practice.*') || request()->is('student/practice*')) {
                return true;
            }
            if ($currentQuizType === 'practice') {
                return true;
            }
            return false;
        }

        // 2. Online Quizzes (including live quiz rooms, lobby, and result details of non-practice quizzes)
        if ($this->menu_key === 'online_quiz' || $this->route_name === 'student.quiz.index') {
            if ($currentQuizType === 'practice') {
                return false; // If taking a practice exam, practice_tests is active, not online_quiz
            }
            if (request()->routeIs('student.quiz.index') || request()->is('student/quiz')) {
                return true;
            }
            if ($currentQuizType !== false && $currentQuizType !== 'practice') {
                return true;
            }
            // If on generic student.quiz.* (like lobby) and not practice
            if ((request()->routeIs('student.quiz.*') || request()->is('student/quiz/*')) && !request()->routeIs('student.results.*')) {
                return true;
            }
            return false;
        }

        // 3. Results
        if ($this->menu_key === 'results' || $this->route_name === 'student.results.index') {
            if (request()->routeIs('student.results.*') || request()->is('student/results*')) {
                return true;
            }
            return false;
        }

        // 4. Exam History
        if ($this->menu_key === 'exam_history' || $this->route_name === 'student.exams.history') {
            if (request()->routeIs('student.exams.history', 'student.quiz.history') || request()->is('student/exams/history*', 'student/quiz/history*')) {
                return true;
            }
            return false;
        }

        // 5. Upcoming Exams
        if ($this->menu_key === 'upcoming_exams' || $this->route_name === 'student.exams.upcoming') {
            if (request()->routeIs('student.exams.upcoming') || request()->is('student/exams/upcoming*')) {
                return true;
            }
            return false;
        }

        // 6. My Courses (including lesson player and learning details)
        if ($this->menu_key === 'my_courses' || $this->route_name === 'student.courses.my') {
            if (request()->routeIs('student.courses.my', 'student.courses.learn', 'student.courses.toggle-lesson') || request()->is('student/courses/my*', 'student/courses/*/learn*')) {
                return true;
            }
        }

        // 7. Generic route prefix matching for any detail/sub-pages (e.g. student.support.show -> student.support)
        if (!empty($this->route_name)) {
            if (request()->routeIs($this->route_name) || request()->routeIs($this->route_name . '.*') || request()->routeIs($this->route_name . '*')) {
                return true;
            }

            $resourcePrefix = preg_replace('/(\.index|\.list|\.my)$/', '', $this->route_name);
            if (!empty($resourcePrefix) && $resourcePrefix !== $this->route_name) {
                if (request()->routeIs($resourcePrefix . '.*') || request()->routeIs($resourcePrefix)) {
                    return true;
                }
            }
        }

        // 8. Generic URL matching
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
