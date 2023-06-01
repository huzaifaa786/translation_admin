<?php
namespace App\Helpers;

use App\Models\Order;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use stdClass;

class Report
{
    public static function MonthlySale($month, $year){

        $start = Carbon::createFromDate($year,$month)->startOfMonth();
        $end = Carbon::createFromDate($year,$month)->endOfMonth();

        $days = [];
        while($start <= $end){
            $obj = new stdClass();
            $clone = clone $start;
            $obj->date = $start->day;
            $obj->amount = Order::whereBetween('created_at',[$start,$clone->endOfDay()])->where('status',3)->sum('price');
            $days[] = $obj;
            $start->addDay();
        }
        return $days;
    }








    public static function YearlySale($year){
        $start = Carbon::createFromDate($year)->startOfYear();
        $end = Carbon::createFromDate($year)->endOfYear();

        $months = [];
        while($start <= $end){
            $obj = new stdClass();
            $clone = clone $start;
            $obj->number = $start->month;
            $obj->amount = Order::whereBetween('created_at',[$start,$clone->endOfMonth()])->sum('amount');
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
    public static function weaklySale($weak){
        $start = Carbon::createFromDate($weak)->startOfweak();
        $end = Carbon::createFromDate($weak)->endOfweak();

        $days = [];
        while($start <= $end){
            $obj = new stdClass();
            $clone = clone $start;
            $obj->number = $start->day;
            $obj->amount = Order::whereBetween('created_at',[$start,$clone->endOfday()])->sum('amount');
            $months[] = $obj;
            $start->addday();
        }

        return $days;
    }




}
