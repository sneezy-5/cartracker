<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];


    // public static function getWeeklyRevenueForCurrentMonth()
    // {
    //     $now = Carbon::now();
    //     $year = $now->year;
    //     $month = $now->month;

    //     $weeklyRevenue = DB::table('bookings')
    //         ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, WEEK(created_at, 1) as week, SUM(amount) as total_amount')
    //         ->whereYear('created_at', $year)
    //         ->whereMonth('created_at', '>=', $month)
    //         ->groupBy('year', 'month', 'week')
    //         ->get()
    //         ->groupBy(['year', 'month']);

    //     $result = [];
    //     $i=0;
    //     for ($m = $month; $m <= $month; $m++) {
    //         // $result = [];
    //         foreach ($weeklyRevenue[$year][$m] as $weekData) {
    //             $week = $weekData->week;
    //             $result[$i++] = isset($weekData->total_amount) ? $weekData->total_amount : 0;;

    //         }
    //     }
    //     return $result;
    // }


    public static function getWeeklyRevenueForCurrentMonth()
{
    $now = Carbon::now();
    $year = $now->year;
    $month = $now->month;

    $weeklyRevenue = DB::table('bookings')
        ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, WEEK(created_at, 1) as week, SUM(amount) as total_amount')
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', '>=', $month)
        ->groupBy('year', 'month', 'week')
        ->get()
        ->groupBy(['year', 'month']);

    $result = [];

    if (isset($weeklyRevenue[$year][$month])) {
        foreach ($weeklyRevenue[$year][$month] as $weekData) {
            $result[] = isset($weekData->total_amount) ? $weekData->total_amount : 0;
        }
    }

    return $result;
}


public function car()
{
    return $this->belongsTo(Cars::class);
}

}
