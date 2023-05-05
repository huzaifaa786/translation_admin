<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
       $data= Service::create($request->all());
       return Api::setResponse('services', $data);
    }
}
