<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\DriverDocument;
use App\Models\DriverFile;
use App\Models\LotteryTicket;
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

            if ($driver) {

                $telegramUser->update([
                    'state' => 'completed'
                ]);

                $this->sendMessage(
                    $chatId,
                    "📄 Yangi CMR faylini yuboring"
                );

                return;
            }

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
                    'state' => 'full_name'
                ]);

                $this->sendMessage(
                    $chatId,
                    "✍️ F.I.Sh ni to'liq kiriting.\n\nMasalan:\nRo'ziyev Sanjarbek Sobir o'g'li"
                );

                break;

            case 'full_name':

                $driver = Driver::find($telegramUser->driver_id);

                $driver->update([
                    'full_name' => $text
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
            case 'completed':

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

                $fileName = uniqid('cmr_') . '.' . $extension;

                Storage::disk('public')->put(
                    "cmr/{$fileName}",
                    $fileContent
                );

                $driverFile = DriverFile::create([
                    'driver_id' => $telegramUser->driver_id,
                    'type'      => 'cmr',
                    'name'      => $fileName,
                    'path'      => "cmr/{$fileName}",
                ]);

                // Ticket yaratish


                $this->sendMessage(
                    $chatId,
                    "✅ CMR qabul qilindi.\n\nAdmin javobini kuting"
                );

                break;
            case 'car_volume':

                $driver = Driver::find($telegramUser->driver_id);

                $driver->update([
                    'car_volume' => $text
                ]);

                $telegramUser->update([
                    'state' => 'completed'
                ]);

                $this->sendMessage(
                    $chatId,
                    '✅ Registratsiya tugadi. Endi CMR yuborishingiz mumkin.'
                );

                break;

            case 'completed':

                if (!isset($message['photo']) && !isset($message['document'])) {
                    return;
                }

                // DriverFile yaratish
                // LotteryTicket yaratish

                $this->sendMessage(
                    $chatId,
                    '✅ Arizangiz qabul qilindi. Admin javobini kuting.'
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
