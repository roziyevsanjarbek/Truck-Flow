<?php

namespace App\Http\Controllers;

use App\Models\CargoRequest;
use App\Models\Driver;
use App\Models\DriverDocument;
use App\Models\DriverFile;
use App\Models\Country;
use App\Models\City;
use App\Models\TelegramUser;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TelegramController extends Controller
{

    private string $token;

    private string $apiUrl;

    public function __construct()
    {
        $this->token = config('services.telegram.bot_token');
        $this->apiUrl = "https://api.telegram.org/bot{$this->token}";
    }

    /**
     * @throws ConnectionException
     */
    public function webhook(Request $request)
    {
        try {

            $update = $request->all();

            if (isset($update['message'])) {
                $this->handleMessage($update['message']);
            }

            if (isset($update['callback_query'])) {
                $this->handleCallbackQuery($update['callback_query']);
            }

            return response()->json(['ok' => true]);

        } catch (\Throwable $e) {

            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @throws ConnectionException
     */
    public function handleMessage(array $message)
    {
        $chatId = $message['chat']['id'];
        $text = $message['text'] ?? null;

        $telegramUser = TelegramUser::firstOrCreate(
            ['telegram_id' => $chatId]
        );

        if ($text === '/start') {

            $driver = Driver::query()->where('telegram_id', $chatId)->first();


            $telegramUser->update([
                'state' => 'phone'
            ]);

            Http::post("{$this->apiUrl}/sendMessage", [
                'chat_id' => $chatId,
                'text' => '📱 Telefon raqamingizni yuboring',
                'reply_markup' => json_encode([
                    'keyboard' => [
                        [
                            [
                                'text' => '📞 Telefon raqam yuborish',
                                'request_contact' => true
                            ]
                        ]
                    ],
                    'resize_keyboard' => true,
                    'one_time_keyboard' => true
                ])
            ]);

            return;
        }

        switch ($telegramUser->state) {

            case 'phone':

                if (!isset($message['contact'])) {
                    return;
                }

                $driver = Driver::create([
                    'telegram_id' => $chatId,
                    'phone_number' => $message['contact']['phone_number'],
                    'status' => 'active'
                ]);

                $telegramUser->update([
                    'driver_id' => $driver->id,
                    'state' => 'last_name'
                ]);

                $this->sendMessage(
                    $chatId,
                    "✍️ Familiyangizni kiriting\n\nMasalan: RO'ZIYEV"
                );

                break;

            case 'last_name':

                $driver = Driver::find($telegramUser->driver_id);

                $driver->update([
                    'last_name' => mb_strtoupper($text)
                ]);

                $telegramUser->update([
                    'state' => 'first_name'
                ]);

                $this->sendMessage(
                    $chatId,
                    "✍️ Ismingizni kiriting\n\nMasalan: SANJARBEK"
                );

                break;

            case 'first_name':

                $driver = Driver::find($telegramUser->driver_id);

                $driver->update([
                    'first_name' => mb_strtoupper($text)
                ]);

                $telegramUser->update([
                    'state' => 'middle_name'
                ]);

                $this->sendMessage(
                    $chatId,
                    "✍️ Sharifingizni kiriting\n\nMasalan: SOBIR O'G'LI"
                );

                break;

            case 'middle_name':

                $driver = Driver::find($telegramUser->driver_id);

                $driver->update([
                    'middle_name' => mb_strtoupper($text)
                ]);

                $telegramUser->update([
                    'state' => 'passport'
                ]);

                $this->sendMessage(
                    $chatId,
                    '📷 Pasport rasmini yuboring'
                );

                break;

            case 'passport':

                if (!isset($message['photo'])) {
                    return;
                }

                $photo = end($message['photo']);

                $fileId = $photo['file_id'];

                // Telegramdan file ma'lumotini olish
                $response = Http::get(
                    "{$this->apiUrl}/getFile",
                    [
                        'file_id' => $fileId
                    ]
                );

                $filePath = $response['result']['file_path'];

                // Faylni yuklab olish
                $fileContent = Http::get(
                    "https://api.telegram.org/file/bot{$this->token}/{$filePath}"
                )->body();

                $extension = pathinfo($filePath, PATHINFO_EXTENSION);

                $fileName = uniqid('passport_') . '.' . $extension;

                Storage::disk('public')->put(
                    "document/{$fileName}",
                    $fileContent
                );

                \Log::info(Storage::disk('public')->exists("document/{$fileName}"));

                \Log::info(Storage::disk('public')->path("document/{$fileName}"));

                DriverDocument::create([
                    'driver_id' => $telegramUser->driver_id,
                    'type'      => 'passport',
                    'name'      => $fileName,
                    'path'      => "document/{$fileName}",
                ]);

                $telegramUser->update([
                    'state' => 'car_number'
                ]);

                $this->sendMessage(
                    $chatId,
                    '🚛 Mashina raqamini kiriting'
                );

                break;
            case 'car_number':

                $driver = Driver::find($telegramUser->driver_id);

                $driver->update([
                    'car_number' => $text
                ]);

                $telegramUser->update([
                    'state' => 'car_type'
                ]);

                Http::post("{$this->apiUrl}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => 'Mashina turini tanlang',
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [
                                [
                                    'text' => 'Tent',
                                    'callback_data' => 'tent'
                                ],
                                [
                                    'text' => 'Ref',
                                    'callback_data' => 'ref'
                                ]
                            ]
                        ]
                    ])
                ]);

                break;

            case 'car_volume':

                $driver = Driver::find($telegramUser->driver_id);

                $driver->update([
                    'car_volume' => $text
                ]);

                $telegramUser->update([
                    'state' => 'from_country'
                ]);

                $countries = Country::all();

                $keyboard = [];

                foreach ($countries->chunk(2) as $chunk) {

                    $row = [];

                    foreach ($chunk as $country) {
                        $row[] = [
                            'text' => $country->name,
                            'callback_data' => 'from_country_'.$country->id
                        ];
                    }

                    $keyboard[] = $row;
                }
                Http::post("{$this->apiUrl}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => '🌍 Yuk qayerdan olinmoqda? Davlatni tanlang',
                    'reply_markup' => json_encode([
                        'inline_keyboard' => $keyboard
                    ])
                ]);

                break;


            case 'unloading_date':

                $date = str_replace(
                    ['/', '.', ' '],
                    '-',
                    trim($text)
                );

                try {

                    $date = \Carbon\Carbon::parse($date)
                        ->format('Y-m-d');

                } catch (\Exception $e) {

                    $this->sendMessage(
                        $chatId,
                        "❌ Sanani to'g'ri kiriting.\n\nMisol: 2026-12-12"
                    );

                    return;
                }

                $cargoRequest = CargoRequest::query()
                    ->where('driver_id', $telegramUser->driver_id)
                    ->latest()
                    ->first();

                $cargoRequest->update([
                    'unloading_date' => $date,
                ]);

                $telegramUser->update([
                    'state' => 'cmr'
                ]);

                $this->sendMessage(
                    $chatId,
                    '📄 CMR rasmini yuboring'
                );

                break;

            case 'cmr':

                if (!isset($message['photo'])) {
                    return;
                }

                $photo = end($message['photo']);

                $fileId = $photo['file_id'];

                $response = Http::get(
                    "{$this->apiUrl}/getFile",
                    [
                        'file_id' => $fileId
                    ]
                );

                $filePath = $response['result']['file_path'];

                $fileContent = Http::get(
                    "https://api.telegram.org/file/bot{$this->token}/{$filePath}"
                )->body();

                $extension = pathinfo($filePath, PATHINFO_EXTENSION);

                $fileName = uniqid('cmr_') . '.' . $extension;

                Storage::disk('public')->put(
                    "cmr/{$fileName}",
                    $fileContent
                );

                $cargoRequest = CargoRequest::query()
                    ->where('driver_id', $telegramUser->driver_id)
                    ->latest()
                    ->first();

                DriverFile::create([
                    'cargo_request_id' => $cargoRequest->id,
                    'type' => 'cmr',
                    'name' => $fileName,
                    'path' => "cmr/{$fileName}",
                ]);

                $telegramUser->update([
                    'state' => 'completed'
                ]);

                $this->sendMessage(
                    $chatId,
                    "✅ Arizangiz qabul qilindi.\n\nAdmin javobini kuting"
                );

                break;
        }
    }

    public function handleCallbackQuery(array $callbackQuery)
    {
        $chatId = $callbackQuery['message']['chat']['id'];
        $messageId = $callbackQuery['message']['message_id'];
        $data = $callbackQuery['data'];

        $telegramUser = TelegramUser::where(
            'telegram_id',
            $chatId
        )->first();

        $driver = Driver::find(
            $telegramUser->driver_id
        );

        if (in_array($data, ['tent', 'ref'])) {

            $driver->update([
                'car_type' => $data
            ]);

            $telegramUser->update([
                'state' => 'car_volume'
            ]);

            $this->editMessageText(
                $chatId,
                $messageId,
                '📦 Mashina kubaturasini kiriting'
            );
        }

        if (str_starts_with($data, 'from_country_')) {

            $countryId = str_replace('from_country_', '', $data);

            $telegramUser->update([
                'from_country_id' => $countryId,
                'state' => 'from_city'
            ]);

            $cities = City::where('country_id', $countryId)->get();

            $keyboard = [];

            foreach ($cities as $city) {
                $keyboard[] = [[
                    'text' => $city->name,
                    'callback_data' => 'from_city_'.$city->id
                ]];
            }
            $keyboard[] = [[
                'text' => '⬅️ Davlatlarga qaytish',
                'callback_data' => 'back_to_from_country'
            ]];


            Http::post("{$this->apiUrl}/editMessageText", [
                'chat_id' => $chatId,
                'message_id' => $messageId,
                'text' => '🏙 Yuk olinadigan shaharni tanlang',
                'reply_markup' => json_encode([
                    'inline_keyboard' => $keyboard
                ])
            ]);

            return;
        }

        if (str_starts_with($data, 'from_city_')) {

            $cityId = str_replace('from_city_', '', $data);

            $telegramUser->update([
                'from_city_id' => $cityId,
                'state' => 'to_country'
            ]);

            $countries = Country::all();

            $keyboard = [];

            foreach ($countries as $country) {
                $keyboard[] = [[
                    'text' => $country->name,
                    'callback_data' => 'to_country_'.$country->id
                ]];
            }


            Http::post("{$this->apiUrl}/editMessageText", [
                'chat_id' => $chatId,
                'message_id' => $messageId,
                'text' => '🌍 Yuk qayerga olib boriladi? Davlatni tanlang',
                'reply_markup' => json_encode([
                    'inline_keyboard' => $keyboard
                ])
            ]);

            return;
        }

        if (str_starts_with($data, 'to_country_')) {

            $countryId = str_replace('to_country_', '', $data);

            $telegramUser->update([
                'to_country_id' => $countryId,
                'state' => 'to_city'
            ]);

            $cities = City::where('country_id', $countryId)->get();

            $keyboard = [];

            foreach ($cities as $city) {
                $keyboard[] = [[
                    'text' => $city->name,
                    'callback_data' => 'to_city_'.$city->id
                ]];
            }

            $keyboard[] = [[
                'text' => '⬅️ Davlatlarga qaytish',
                'callback_data' => 'back_to_to_country'
            ]];

            Http::post("{$this->apiUrl}/editMessageText", [
                'chat_id' => $chatId,
                'message_id' => $messageId,
                'text' => '🏙 Yetkazib beriladigan shaharni tanlang',
                'reply_markup' => json_encode([
                    'inline_keyboard' => $keyboard
                ])
            ]);

            return;
        }

        if (str_starts_with($data, 'to_city_')) {

            $cityId = str_replace('to_city_', '', $data);

            CargoRequest::create([
                'driver_id' => $telegramUser->driver_id,

                'from_country_id' => $telegramUser->from_country_id,
                'from_city_id' => $telegramUser->from_city_id,

                'to_country_id' => $telegramUser->to_country_id,
                'to_city_id' => $cityId,
            ]);

            $telegramUser->update([
                'state' => 'unloading_date'
            ]);

            $this->editMessageText(
                $chatId,
                $messageId,
                '📅 Yuk tushirish sanasini kiriting (2026-12-10)'
            );

            return;
        }

        if ($data === 'back_to_from_country') {

            $countries = Country::query()->get();

            $keyboard = [];

            foreach ($countries->chunk(2) as $chunk) {

                $row = [];

                foreach ($chunk as $country) {
                    $row[] = [
                        'text' => $country->name,
                        'callback_data' => 'from_country_'.$country->id
                    ];
                }

                $keyboard[] = $row;
            }

            Http::post("{$this->apiUrl}/editMessageText", [
                'chat_id' => $chatId,
                'message_id' => $messageId,
                'text' => '🌍 Yuk qayerdan olinmoqda? Davlatni tanlang',
                'reply_markup' => json_encode([
                    'inline_keyboard' => $keyboard
                ])
            ]);

            return;
        }

        if ($data === 'back_to_to_country') {

            $countries = Country::query()->get();

            $keyboard = [];

            foreach ($countries->chunk(2) as $chunk) {
                $row = [];

                foreach ($chunk as $country) {
                    $row[] = [
                        'text' => $country->name,
                        'callback_data' => 'to_country_'.$country->id
                    ];
                }

                $keyboard[] = $row;
            }

            Http::post("{$this->apiUrl}/editMessageText", [
                'chat_id' => $chatId,
                'message_id' => $messageId,
                'text' => '🌍 Yuk qayerga olib boriladi? Davlatni tanlang',
                'reply_markup' => json_encode([
                    'inline_keyboard' => $keyboard
                ])
            ]);

            return;
        }
    }


    /**
     * @throws ConnectionException
     */
    public function sendMessage(int|string $chatId, string $text)
    {
        Http::post("{$this->apiUrl}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
        ]);
    }

    public function editMessageText($chatId, $messageId, $text)
    {
        Http::post("{$this->apiUrl}/editMessageText", [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $text,
        ]);

    }

}

