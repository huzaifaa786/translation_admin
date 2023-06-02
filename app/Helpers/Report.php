<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\Vendor;
use Illuminate\Support\Carbon;
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

        $start = Carbon::createFromDate(2023, 1, 1); 
        $end = Carbon::createFromDate($year, $month)->endOfMonth();

        $days = [];
        while ($start <= $end) {
            dump($start);
            $obj = new stdClass();
            $clone = clone $start;
            $obj->date = $start;
            $obj->amount = Order::whereBetween('created_at', [$start, $clone->endOfDay()])->where('status', 3)->where('vendor_id', $vendor)->sum('price');
            $obj->ali = "kach";
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
