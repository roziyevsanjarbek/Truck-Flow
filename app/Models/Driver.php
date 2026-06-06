<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';

    protected $fillable = [
        'telegram_id',
        'full_name',
        'phone_number',
        'car_number',
        'car_type',
        'car_volume',
        'status',
    ];
}
