<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Driver extends Model
{
    protected $table = 'drivers';

    protected $fillable = [
        'telegram_id',
        'last_name',
        'first_name',
        'middle_name',
        'phone_number',
        'car_number',
        'car_type',
        'car_volume',
        'status',
    ];

    public function cargoRequests()
    {
        return $this->hasMany(CargoRequest::class);
    }

    protected function lastName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $this->normalizeName($value)
        );
    }

    protected function firstName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $this->normalizeName($value)
        );
    }

    protected function middleName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $this->normalizeName($value)
        );
    }

    private function normalizeName(string $value): string
    {
        $value = strtr($value, [
            'А' => 'A', 'а' => 'a',
            'Б' => 'B', 'б' => 'b',
            'В' => 'V', 'в' => 'v',
            'Г' => 'G', 'г' => 'g',
            'Д' => 'D', 'д' => 'd',
            'Е' => 'E', 'е' => 'e',
            'Ё' => 'YO', 'ё' => 'yo',
            'Ж' => 'J', 'ж' => 'j',
            'З' => 'Z', 'з' => 'z',
            'И' => 'I', 'и' => 'i',
            'Й' => 'Y', 'й' => 'y',
            'К' => 'K', 'к' => 'k',
            'Л' => 'L', 'л' => 'l',
            'М' => 'M', 'м' => 'm',
            'Н' => 'N', 'н' => 'n',
            'О' => 'O', 'о' => 'o',
            'П' => 'P', 'п' => 'p',
            'Р' => 'R', 'р' => 'r',
            'С' => 'S', 'с' => 's',
            'Т' => 'T', 'т' => 't',
            'У' => 'U', 'у' => 'u',
            'Ф' => 'F', 'ф' => 'f',
            'Х' => 'X', 'х' => 'x',
            'Ц' => 'TS', 'ц' => 'ts',
            'Ч' => 'CH', 'ч' => 'ch',
            'Ш' => 'SH', 'ш' => 'sh',
            'Щ' => 'SH', 'щ' => 'sh',
            'Ъ' => '', 'ъ' => '',
            'Ь' => '', 'ь' => '',
            'Э' => 'E', 'э' => 'e',
            'Ю' => 'YU', 'ю' => 'yu',
            'Я' => 'YA', 'я' => 'ya',

            'Қ' => 'Q', 'қ' => 'q',
            'Ғ' => "G'", 'ғ' => "g'",
            'Ҳ' => 'H', 'ҳ' => 'h',
            'Ў' => "O'", 'ў' => "o'",
        ]);

        return mb_strtoupper(trim($value));
    }

    public function documents()
    {
        return $this->hasMany(DriverDocument::class);
    }


}
