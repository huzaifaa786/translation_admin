<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Helpers\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales(Request $request){
        $days = Report::MonthlySale($request->month,$request->year);
        return Api::setResponse('day', $days);
   }

   public function weeklysale(Request $request){
    $days = Report::weaklySale($request->week);
    return Api::setResponse('day', $days);
}
}
