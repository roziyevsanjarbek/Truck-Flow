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


    public function files()
    {
        return $this->hasMany(DriverFile::class);
    }

    public function fromCountry()
    {
        return $this->belongsTo(Country::class,'from_country_id');
    }

    public function toCountry()
    {
        return $this->belongsTo(Country::class,'to_country_id');
    }

    public function fromCity()
    {
        return $this->belongsTo(City::class,'from_city_id');
    }

    public function toCity()
    {
        return $this->belongsTo(City::class,'to_city_id');
    }
}
