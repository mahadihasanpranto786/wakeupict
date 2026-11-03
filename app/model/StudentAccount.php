<?php

namespace App\model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class StudentAccount extends Authenticatable
{
    use Notifiable;

    protected $table = 'student_accounts';

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'meta' => 'array',
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'status' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->student_id_code)) {
                $model->student_id_code = static::generateUniqueStudentId();
            }
        });
    }

    /**
     * Relationship to formally admitted student record
     */
    /**
     * Parent Student master record
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function admitedStudent()
    {
        return $this->belongsTo(AdmitedStudent::class, 'admited_student_id');
    }

    /**
     * LMS enrollments relationship
     */
    public function enrollments()
    {
        return $this->hasMany(LmsEnrollment::class, 'student_account_id');
    }

    /**
     * All enrolled/applied courses via LMS enrollments
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'lms_enrollments', 'student_account_id', 'course_id')
            ->withPivot('batch_id', 'enrollment_type', 'status', 'created_at');
    }

    /**
     * Get distinct list of all enrolled or applied courses for this student account
     */
    public function getFullCoursesListAttribute()
    {
        $courses = collect();

        // 1. From LMS Enrollments
        $enrollments = $this->enrollments()->with(['course', 'batch'])->latest()->get();
        foreach ($enrollments as $enr) {
            if ($enr->course) {
                $courses->push([
                    'id' => $enr->course_id,
                    'title' => $enr->course->course_title,
                    'price' => $enr->course->price,
                    'status' => $enr->status ?: 'active',
                    'enrollment_type' => $enr->enrollment_type ?: 'applied',
                    'batch_number' => $enr->batch ? $enr->batch->batch_number : null,
                    'enrolled_at' => $enr->created_at,
                ]);
            }
        }

        // 2. From admitedStudent if not already included
        if ($this->admitedStudent && $this->admitedStudent->course) {
            $alreadyIncluded = $courses->contains(function ($item) {
                return isset($item['id']) && (int)$item['id'] === (int)$this->admitedStudent->course_id;
            });

            if (!$alreadyIncluded) {
                $courses->push([
                    'id' => $this->admitedStudent->course_id,
                    'title' => $this->admitedStudent->course->course_title,
                    'price' => $this->admitedStudent->course->price,
                    'status' => 'admitted',
                    'enrollment_type' => 'admitted',
                    'batch_number' => $this->admitedStudent->batch ? $this->admitedStudent->batch->batch_number : null,
                    'enrolled_at' => $this->admitedStudent->created_at,
                ]);
            }
        }

        return $courses;
    }

    /**
     * Total count of distinct courses associated with this student account
     */
    public function getCoursesCountAttribute()
    {
        return $this->full_courses_list->count();
    }

    /**
     * LMS lesson progress relationship
     */
    public function lessonProgress()
    {
        return $this->hasMany(LmsLessonProgress::class, 'student_account_id');
    }

    /**
     * Get associated course through admitedStudent or active enrollment
     */
    public function getCourseAttribute()
    {
        if ($this->admitedStudent && $this->admitedStudent->course) {
            return $this->admitedStudent->course;
        }

        $activeEnrollment = $this->enrollments()->with('course')->first();
        return $activeEnrollment ? $activeEnrollment->course : null;
    }

    /**
     * Get associated batch through admitedStudent or active enrollment
     */
    public function getBatchAttribute()
    {
        if ($this->admitedStudent && $this->admitedStudent->batch) {
            return $this->admitedStudent->batch;
        }

        $activeEnrollment = $this->enrollments()->with('batch')->first();
        return $activeEnrollment ? $activeEnrollment->batch : null;
    }

    /**
     * Safe avatar URL accessor
     */
    public function getAvatarUrlAttribute()
    {
        if (!empty($this->avatar)) {
            return safe_asset($this->avatar);
        }

        if ($this->admitedStudent && !empty($this->admitedStudent->student_photo)) {
            return safe_asset($this->admitedStudent->student_photo);
        }

        // Return inline SVG data URI or default fallback avatar
        $initial = strtoupper(substr($this->name ?: 'S', 0, 1));
        return "https://ui-avatars.com/api/?name=" . urlencode($this->name ?: 'Student') . "&background=0b1329&color=10b981&bold=true";
    }

    /**
     * Generate unique student identification code
     * Format: WUICT-YYYY-XXXX (e.g. WUICT-2026-0001)
     */
    public static function generateUniqueStudentId($year = null)
    {
        $year = $year ?: date('Y');
        $prefix = "WUICT-{$year}-";

        $lastRecord = self::where('student_id_code', 'LIKE', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        $sequence = 1;
        if ($lastRecord && preg_match('/WUICT-\d{4}-(\d+)/', $lastRecord->student_id_code, $matches)) {
            $sequence = intval($matches[1]) + 1;
        }

        do {
            $code = $prefix . str_pad($sequence, 4, '0', STR_PAD_LEFT);
            $exists = self::where('student_id_code', $code)->exists();
            if (!$exists) {
                return $code;
            }
            $sequence++;
        } while (true);
    }
}
