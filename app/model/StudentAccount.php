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
        'verified_at' => 'datetime',
        'status' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->attributes['student_id_code'])) {
                $code = !empty($model->registration_number) ? $model->registration_number : static::generateUniqueStudentId();
                $model->attributes['student_id_code'] = $code;
            }
            if (empty($model->attributes['registration_number'])) {
                $model->attributes['registration_number'] = $model->attributes['student_id_code'];
            }
        });
    }

    public function getStudentIdCodeAttribute($value)
    {
        return $this->registration_number ?: $value;
    }

    /**
     * Get the visible portal password for admin display
     */
    public function getDisplayPasswordAttribute()
    {
        if (!empty($this->plain_password)) {
            return $this->plain_password;
        }
        $cleanPhone = preg_replace('/[^0-9]/', '', (string)$this->phone);
        return strlen($cleanPhone) >= 6 ? substr($cleanPhone, -6) : '123456';
    }

    public function verifiedBy()
    {
        return $this->belongsTo(\App\User::class, 'verified_by');
    }

    public function scopePending($query)
    {
        return $query->where('registration_status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('registration_status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('registration_status', 'rejected');
    }

    public function isApproved()
    {
        return $this->registration_status === 'approved';
    }

    public function isPending()
    {
        return $this->registration_status === 'pending';
    }

    public function isRejected()
    {
        return $this->registration_status === 'rejected';
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
     * Helper to get personal/academic details from admitedStudent, student master, or meta
     */
    public function getProfileDetail($field, $default = '')
    {
        if ($this->admitedStudent && !empty($this->admitedStudent->$field)) {
            return $this->admitedStudent->$field;
        }
        if ($this->student && !empty($this->student->$field)) {
            return $this->student->$field;
        }
        if (is_array($this->meta) && !empty($this->meta[$field])) {
            return $this->meta[$field];
        }
        return $default;
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
     * Standard Registration Number format
     */
    public static function generateUniqueStudentId($year = null)
    {
        $year = $year ?: date('Y');
        try {
            return \App\Services\RegistrationNumberService::generate($year, '00', '00');
        } catch (\Exception $e) {
            return $year . '0000' . rand(1000, 9999);
        }
    }
}
