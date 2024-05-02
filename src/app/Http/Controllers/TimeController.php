<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;
use App\Models\User;

class TimeController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
