<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverFile extends Model
{
    protected $table = 'driver_files';

    protected $fillable = [
        'driver_id',
        'type',
        'name',
        'path',
    ];
}
