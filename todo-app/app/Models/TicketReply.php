<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TicketReply extends Model
{
    protected $fillable = ['ticket_id', 'sender_name', 'sender_email', 'message', 'is_admin'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
