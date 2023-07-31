<?php

namespace App\Http\Controllers;

use App\Helpers\Report;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function allsales(){
        $sales = Order::orderByDesc('created_at')->get();
        return view('admin.sale.index')->with('sales',$sales);
    }
    
    public function companysales(Request $request){
        $sales = Order::where('vendor_id',$request->id) ->orderByDesc('created_at')->get();
        return view('admin.sale.index')->with('sales',$sales)->with('id',$request->id);
    }
}