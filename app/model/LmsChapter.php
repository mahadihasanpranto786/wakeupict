<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsChapter extends Model
{
    protected $table = 'lms_chapters';

    protected $guarded = [];

    protected $casts = [
        'order_index' => 'integer',
        'status' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function lessons()
    {
        return $this->hasMany(LmsLesson::class, 'chapter_id')
            ->orderBy('order_index', 'asc')
            ->orderBy('id', 'asc');
    }

    public function activeLessons()
    {
        return $this->hasMany(LmsLesson::class, 'chapter_id')
            ->where('status', 1)
            ->orderBy('order_index', 'asc')
            ->orderBy('id', 'asc');
    }

    /**
     * Compatibility accessor for chapter_name
     */
    public function getChapterNameAttribute()
    {
        return $this->title;
    }

    /**
     * Compatibility accessor for chapter_description
     */
    public function getChapterDescriptionAttribute()
    {
        return $this->description;
    }
}
