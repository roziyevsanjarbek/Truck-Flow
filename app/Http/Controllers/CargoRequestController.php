<?php

namespace App\Http\Controllers;

use App\Models\CargoRequest;
use App\Models\LotteryTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CargoRequestController extends Controller
{

    protected string $token;
    protected string $apiUrl;
    public function __construct()
    {
        $this->token = '8905653221:AAFC1nCPi97AZBX_oycsoGXlT_xCxcg6FjE';
        $this->apiUrl = "https://api.telegram.org/bot{$this->token}";
    }
    public function index()
    {
        $user = auth()->user();
        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        $cargoRequest = CargoRequest::with([
            'driver.documents',
            'fromCountry',
            'toCountry',
            'fromCity',
            'toCity',
            'driver',
            'files' => function($query) {
            $query->where('type', 'cmr');
            },
        ])->paginate(10);


        return response()->json([
            'data' => $cargoRequest,
            'message' => 'success'
        ]);
    }

    public function approve($id)
    {
        $user = auth()->user();
        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        $cargoRequest = CargoRequest::query()
            ->with('driver')
            ->where('status', 'pending')
            ->find($id);

        if (!$cargoRequest) {
            return response()->json([
                'message' => 'Cargo request not found',
            ]);
        }

        $lotteryTicket = LotteryTicket::query()
            ->create([
                'cargo_request_id' => $cargoRequest->id,
                'ticket_number' => 'EGS-' . rand(10000000, 99999999),
                'status' => 'active',
            ]);

        $text = "🎉 Hurmatli haydovchi!\n\n"
            . "Siz yuborgan yuk tashish arizasi muvaffaqiyatli tasdiqlandi. ✅\n\n"
            . "🎟 Sizning lotereya chipta raqamingiz:\n"
            . "🔢 {$lotteryTicket->ticket_number}\n\n"
            . "📌 Iltimos, ushbu raqamni saqlab qo'ying.\n"
            . "Lotereya natijalari e'lon qilinganda aynan shu raqam orqali ishtirokingiz tekshiriladi.\n\n"
            . "🚛 Hamkorligingiz uchun rahmat!\n"
            . "🍀 Omad tilaymiz!";


        Http::post("{$this->apiUrl}/sendMessage", [
            'chat_id' => $cargoRequest->driver->telegram_id,
            'text' => $text,
        ]);


        $cargoRequest->update(['status' => 'approved']);
        return response()->json([
            'message' => 'success',
            'data' => $cargoRequest,
            'lottery_ticket' => $lotteryTicket,
        ]);
    }


    public function reject($id)
    {
        $user = auth()->user();
        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        $cargoRequest = CargoRequest::query()
            ->with('driver')
            ->where('status', 'pending')
            ->find($id);

        if (!$cargoRequest) {
            return response()->json([
                'message' => 'Cargo request not found',
            ]);
        }

        $cargoRequest->update(['status' => 'rejected']);
        return response()->json([
            'message' => 'success',
            'data' => $cargoRequest,
        ]);
    }

    public function getLotteryTicket(string $id)
    {
        $lotteryTicket = LotteryTicket::query()
            ->where('cargo_request_id', $id)
            ->first();

        return response()->json([
            'data' => $lotteryTicket,
            'message' => 'success'
        ]);

    }


    public function search(Request $request)
    {
        $user = auth()->user();
        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        $query = CargoRequest::query()
            ->with([
                'driver.documents',
                'driver',
                'fromCountry',
                'toCountry',
                'fromCity',
                'toCity',
                'files' => function ($q) {
                    $q->where('type', 'cmr');
                },
            ]);

        // Driver name
        if ($request->filled('driver_name')) {
            $query->whereHas('driver', function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->driver_name}%")
                    ->orWhere('last_name', 'like', "%{$request->driver_name}%")
                    ->orWhereRaw(
                        "CONCAT(last_name,' ',first_name) LIKE ?",
                        ["%{$request->driver_name}%"]
                    );
            });
        }



        // Vehicle Number
        if ($request->filled('car_number')) {
            $query->whereHas('driver', function ($q) use ($request) {
                $q->where('car_number', 'like', "%{$request->car_number}%");
            });
        }

        // From Country
        if ($request->filled('from_country_id')) {
            $query->where('from_country_id', $request->from_country_id);
        }

        // To Country
        if ($request->filled('to_country_id')) {
            $query->where('to_country_id', $request->to_country_id);
        }

        // Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Unloading Date
        if ($request->filled('unloading_date')) {
            $query->whereDate('unloading_date', $request->unloading_date);
        }

        // Car Type
        if ($request->filled('car_type')) {
            $query->whereHas('driver', function ($q) use ($request) {
                $q->where('car_type', $request->car_type);
            });
        }

        return response()->json([
            'message' => 'success',
            'data' => $query->latest()->paginate(10),
        ]);
    }

    public function statisticsDashboard()
    {
        $startDate = Carbon::today()->subDays(6)->startOfDay();
        $endDate = Carbon::today()->endOfDay();

        // 7 kunlik statistika
        $dailyStats = CargoRequest::selectRaw("
            DATE(created_at) as date,
            status,
            COUNT(*) as total
        ")
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(created_at)'), 'status')
            ->orderBy('date')
            ->get();

        // Umumiy status statistikasi
        $statusStats = CargoRequest::selectRaw("
            status,
            COUNT(*) as total
        ")
            ->groupBy('status')
            ->pluck('total', 'status');

        $labels = [];
        $pending = [];
        $approved = [];
        $rejected = [];
        $total = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::today()->subDays($i)->format('Y-m-d');

            $labels[] = Carbon::parse($date)->format('M d');

            $day = $dailyStats->where('date', $date);

            $pendingCount = optional($day->firstWhere('status', 'pending'))->total ?? 0;
            $approvedCount = optional($day->firstWhere('status', 'approved'))->total ?? 0;
            $rejectedCount = optional($day->firstWhere('status', 'rejected'))->total ?? 0;

            $pending[] = $pendingCount;
            $approved[] = $approvedCount;
            $rejected[] = $rejectedCount;
            $total[] = $pendingCount + $approvedCount + $rejectedCount;
        }

        return response()->json([

            'labels' => $labels,

            'lineChart' => [
                'pending' => $pending,
                'approved' => $approved,
                'rejected' => $rejected,
                'total' => $total,
            ],

            'pieChart' => [
                'pending' => $statusStats['pending'] ?? 0,
                'approved' => $statusStats['approved'] ?? 0,
                'rejected' => $statusStats['rejected'] ?? 0,
                'total' => array_sum($statusStats->toArray()),
            ],

        ]);
    }


    public function statistics()
    {
        $user = auth()->user();
        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        $cargoRequest = CargoRequest::query()
            ->selectRaw('count(*) as total, status')
            ->groupBy('status')
            ->get();

        $todayRequests = CargoRequest::query()
            ->whereDate('created_at', today())
            ->count();

        return response()->json([
            'data' => $cargoRequest,
            'today_requests' => $todayRequests,
            'message' => 'success'
        ]);
    }

}
