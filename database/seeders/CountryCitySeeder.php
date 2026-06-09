<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CountryCitySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            'Rossiya' => [
                'Moskva',
                'Sankt-Peterburg',
                'Qozon',
                'Novosibirsk',
                'Yekaterinburg',
                'Krasnodar',
                'Samara',
                'Omsk',
                'Chelyabinsk',
                'Ufa',
                'Rostov-na-Donu',
                'Volgograd',
            ],

            'Belarus' => [
                'Minsk',
                'Brest',
                'Grodno',
                'Gomel',
                'Mogilev',
                'Vitebsk',
            ],

            'Turkiya' => [
                'Istanbul',
                'Anqara',
                'Izmir',
                'Bursa',
                'Antalya',
                'Konya',
                'Mersin',
            ],

            'Litva' => [
                'Vilnyus',
                'Kaunas',
                'Klaipeda',
                'Siauliai',
                'Panevezys',
            ],

            'Xitoy' => [
                'Pekin',
                'Shanxay',
                'Guanchjou',
                'Shenchjen',
                'Urumchi',
                'Tyanjin',
            ],

            'Koreya' => [
                'Seul',
                'Busan',
                'Incheon',
                'Daegu',
                'Daejeon',
            ],

            'Turkmaniston' => [
                'Ashxobod',
                'Turkmanobod',
                'Dashoguz',
                'Mary',
                'Balkanabat',
            ],

            'O\'zbekiston' => [
                'Toshkent',
                'Samarqand',
                'Buxoro',
                'Andijon',
                'Namangan',
                'Farg\'ona',
                'Nukus',
                'Qarshi',
                'Termiz',
                'Jizzax',
                'Navoiy',
                'Urganch',
            ],

            'Qirg\'iziston' => [
                'Bishkek',
                'O\'sh',
                'Jalolobod',
                'Qorako\'l',
                'Talas',
                'Norin',
            ],

            'Qozog\'iston' => [
                'Olmaota',
                'Astana',
                'Shimkent',
                'Aqtobe',
                'Atyrau',
                'Qarag\'anda',
                'Qo\'stanay',
                'Pavlodar',
            ],

            'Singapur' => [
                'Singapore',
            ],
        ];

        foreach ($countries as $countryName => $cities) {

            $country = Country::create([
                'name' => $countryName
            ]);

            foreach ($cities as $cityName) {
                City::create([
                    'country_id' => $country->id,
                    'name' => $cityName
                ]);
            }
        }
    }
}
