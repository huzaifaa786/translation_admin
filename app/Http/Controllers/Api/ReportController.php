<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Helpers\Report;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $vendor = Auth::user()->id;
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $days = Report::totalSale($month, $year, $vendor);
        return Api::setResponse('day', $days);
    }

    public function weeklysale(Request $request)
    {
        $vendor = Auth::user()->id;
        $days = Report::weaklySale($request->week,$vendor);
        return Api::setResponse('days', $days);
    }
}
