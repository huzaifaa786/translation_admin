<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\Vendor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use stdClass;

class Report
{
    public static function MonthlySale($month, $year, $vendor)
    {

        $start = Carbon::createFromDate($year, $month)->startOfMonth();
        $end = Carbon::createFromDate($year, $month)->endOfMonth();

        $days = [];
        while ($start <= $end) {
            $obj = new stdClass();
            $clone = clone $start;
            $obj->date = $start->day;
            $obj->amount = Order::whereBetween('created_at', [$start, $clone->endOfDay()])->where('status', 3)->where('vendor_id', $vendor)->sum('price');
            $days[] = $obj;
            $start->addDay();
        }
        return $days;
    }
    public static function totalSale($month, $year, $vendor)
    {
        $start = Carbon::createFromDate($year, $month, 1);
        $endOfMonth = Carbon::createFromDate($year, $month)->endOfMonth();
        $days = [];

        while ($start <= $endOfMonth) {
            $obj = new stdClass();
            $obj->date = Carbon::createMidnightDate($start->year, $start->month, $start->day);

            // Fetch the sum and currency for the given date
            $data = DB::table('orders')
            ->select('currency', DB::raw('SUM(price) as total_amount'))
            ->whereDate('created_at', $start)
                ->whereIn('status', [3])
                ->where('vendor_id', $vendor)
                ->groupBy('currency')
                ->first();

            $obj->amount = intval($data->total_amount ?? 0); // Cast to integer
            $obj->currency = $data->currency ?? 'USD'; // Default to 'USD' if no currency found

            $days[] = $obj;
            $start->addDay();
        }

        return $days;
    }











    public static function YearlySale($year)
    {
        $start = Carbon::createFromDate($year)->startOfYear();
        $end = Carbon::createFromDate($year)->endOfYear();

        $months = [];
        while ($start <= $end) {
            $obj = new stdClass();
            $clone = clone $start;
            $obj->number = $start->month;
            $obj->amount = Order::whereBetween('created_at', [$start, $clone->endOfMonth()])->sum('amount');
            $months[] = $obj;
            $start->addMonth();
        }

        return $months;
    }

    //Not included in this project//
    // public static function YearlyPurchase($year){
    //     $start = Carbon::today()->startOfYear($year);
    //     $end = Carbon::today()->endOfYear($year)->endOfDay();

    //     $months = [];
    //     while($start <= $end){
    //         $obj = new stdClass();
    //         $clone = clone $start;
    //         $obj->number = $start->month;
    //         $obj->amount = Purchase::whereBetween('created_at',[$start,$clone->endOfMonth()])->sum('amount');
    //         $months[] = $obj;
    //         $start->addMonth();
    //     }
    //     return $months;
    // }
    //Not included in this project//
    public static function weaklySale($week)
    {
        $start = Carbon::createFromDate($week)->startOfweek();
        $end = Carbon::createFromDate($week)->endOfweek();

        $days = [];
        while ($start <= $end) {
            $obj = new stdClass();
            $clone = clone $start;
            $obj->number = $start->day;
            $obj->amount = Order::whereBetween('created_at', [$start, $clone->endOfday()])->sum('price');
            $days[] = $obj;
            $start->addday();
        }

        return $days;
    }
}
