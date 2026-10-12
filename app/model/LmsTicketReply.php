<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LmsTicketReply extends Model
{
    protected $table = 'lms_ticket_replies';

    protected $guarded = [];

    public function ticket()
    {
        return $this->belongsTo(LmsSupportTicket::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function student()
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }
}
