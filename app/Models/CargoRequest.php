<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargoRequest extends Model
{
    protected $table = 'cargo_requests';

    protected $fillable = [
        'driver_id',
        'from_country_id',
        'from_city_id',
        'to_country_id',
        'to_city_id',
        'unloading_date',
        'status',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
