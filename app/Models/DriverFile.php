<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverFile extends Model
{
    protected $table = 'driver_files';

    protected $fillable = [
        'cargo_request_id',
        'type',
        'name',
        'path',
    ];
}
