<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Cars;
use App\Models\Transactions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request['start_date'];
        $endDate = $request['end_date'];

        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));


        $cars = Cars::count();

        $car_available = Cars::where('status', 'disponible')
                            ->count();

        $car_unavailable = Cars::whereDate('updated_at', '>=', $startDate)
                              ->whereDate('updated_at', '<=', $endDate)
                              ->where('status', 'en location')
                              ->count();

        $bookings = Booking::whereDate('updated_at', '>=', $startDate)
                        ->whereDate('updated_at', '<=', $endDate)
                        ->count();

        $transactions = Transactions::whereDate('updated_at', '>=', $startDate)
                        ->whereDate('updated_at', '<=', $endDate)
                        ->count();

        $CA = Transactions::getCA($startDate,$endDate);

        $depense = Transactions::getDepense($startDate,$endDate);
        $revenu = $CA - $depense;

        $weeklyRevenueForCurrentMonth = Booking::getWeeklyRevenueForCurrentMonth();

       //dd($weeklyRevenueForCurrentMonth);
        return response()->json([
            'data' =>[
                'car_available'=> $car_available,
                'car_unavailable'=> $car_unavailable,
                'cars'=> $cars,
                'bookings'=> $bookings,
                'revenu'=> $revenu,
                'depense'=> $depense,
                'CA'=> $CA,
                'transaction'=>$transactions,
                'weeklyRevenueForCurrentMonth'=>$weeklyRevenueForCurrentMonth
            ],
        ]);

    }


}
