<?php

namespace App\Http\Controllers;

use App\Helpers\ApiValidate;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isTrue;

class CompanyController extends Controller
{
    public function index()
    {
        $companyusers = User::where('is_company', true)->get();
        return view('admin.companyUser.create')->with('companyusers', $companyusers);
    }
    public function store(Request $request)
    {
        dd($request);
        $credentials = ApiValidate::userregister($request,  User::class);
        $user = User::create([
            'is_company' => true,
            'user_type' => 'Email',
        ] + $credentials);

        Account::create([

            'user_id' => $user->id,
            'balance' => '0'

        ]);
        return redirect()->back();
    }
}
