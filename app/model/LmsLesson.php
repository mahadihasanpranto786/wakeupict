<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsLesson extends Model
{
    protected $table = 'lms_lessons';

    protected $guarded = [];

    protected $casts = [
        'is_free_preview' => 'boolean',
        'duration_minutes' => 'integer',
        'order_index' => 'integer',
        'status' => 'integer',
    ];

    public function chapter()
    {
        return $this->belongsTo(LmsChapter::class, 'chapter_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function progress()
    {
        return $this->hasMany(LmsLessonProgress::class, 'lesson_id');
    }

    /**
     * Check if lesson is completed by given student account
     */
    public function isCompletedBy($studentAccountId)
    {
        return LmsLessonProgress::where('student_account_id', $studentAccountId)
            ->where('lesson_id', $this->id)
            ->where('is_completed', true)
            ->exists();
    }

    /**
     * Compatibility accessor for lesson_title
     */
    public function getLessonTitleAttribute()
    {
        return $this->title;
    }

    /**
     * Formatted duration string
     */
    public function getFormattedDurationAttribute()
    {
        return $this->duration_minutes ? $this->duration_minutes . ' mins' : '15 mins';
    }

    /**
     * Get safe embed URL for YouTube, Vimeo, or HTML5
     */
    public function getVideoEmbedUrlAttribute()
    {
        if (empty($this->video_url)) {
            return null;
        }

        $url = trim($this->video_url);

        // YouTube URL formats: watch?v=ID, youtu.be/ID, embed/ID
        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            $videoId = '';
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $match)) {
                $videoId = $match[1];
            }
            return $videoId ? "https://www.youtube-nocookie.com/embed/{$videoId}?rel=0&modestbranding=1" : $url;
        }

        // Vimeo URL formats: vimeo.com/ID
        if (strpos($url, 'vimeo.com') !== false) {
            if (preg_match('/vimeo\.com\/(?:video\/)?([0-9]+)/', $url, $match)) {
                return "https://player.vimeo.com/video/{$match[1]}";
            }
        }

        return $url;
    }

    public function getEmbedVideoUrlAttribute()
    {
        return $this->getVideoEmbedUrlAttribute();
    }
}
