<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LotteryTicket extends Model
{
    protected $table = 'lottery_tickets';

    protected $fillable = [
        'cargo_request_id',
        'ticket_number',
        'status',
        'won_at',
    ];
}
