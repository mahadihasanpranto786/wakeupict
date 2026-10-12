<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsSupportTicket extends Model
{
    protected $table = 'lms_support_tickets';

    protected $guarded = [];

    protected $casts = [
        'last_reply_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }

    public function replies()
    {
        return $this->hasMany(LmsTicketReply::class, 'ticket_id')->orderBy('created_at', 'asc');
    }

    public static function generateTicketNumber()
    {
        $year = date('Y');
        $random = strtoupper(substr(md5(uniqid(rand(), true)), 0, 5));
        return "TKT-{$year}-{$random}";
    }
}
