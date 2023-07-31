<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use Illuminate\Http\Request;

class BugController extends Controller
{
    public function index()
    {
        $bugs = Bug::all();
        return view('admin.bug.index')->with('bugs', $bugs);
    }
}
