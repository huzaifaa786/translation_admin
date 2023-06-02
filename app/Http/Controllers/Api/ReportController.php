<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Helpers\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function sales(Request $request){
        $vendor= Auth::user()->id;
        dd($vendor);
        $days = Report::MonthlySale($request->month,$request->year);
        return Api::setResponse('day', $days);
   }

   public function weeklysale(Request $request){
    $days = Report::weaklySale($request->week);
    return Api::setResponse('days', $days);
}
}
