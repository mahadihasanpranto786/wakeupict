<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LmsClassSchedule extends Model
{
    protected $table = 'lms_class_schedules';

    protected $guarded = [];

    protected $casts = [
        'class_date' => 'date',
        'is_cancelled' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function instructor()
    {
        return $this->belongsTo(\App\User::class, 'instructor_id');
    }

    public function attendances()
    {
        return $this->hasMany(LmsAttendance::class, 'schedule_id');
    }

    /**
     * Check if class is live right now
     */
    public function isLiveNow()
    {
        if ($this->is_cancelled) {
            return false;
        }

        $now = Carbon::now();
        $dateStr = $this->class_date->format('Y-m-d');
        $start = Carbon::parse($dateStr . ' ' . $this->start_time);
        $end = Carbon::parse($dateStr . ' ' . $this->end_time);

        return $now->between($start, $end);
    }

    /**
     * Check if class is in the future
     */
    public function isUpcoming()
    {
        if ($this->is_cancelled) {
            return false;
        }

        $now = Carbon::now();
        $dateStr = $this->class_date->format('Y-m-d');
        $start = Carbon::parse($dateStr . ' ' . $this->start_time);

        return $start->isFuture();
    }

    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->start_time)->format('h:i A') . ' – ' . Carbon::parse($this->end_time)->format('h:i A');
    }
}
