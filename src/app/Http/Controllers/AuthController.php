<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
// use App\Models\Time;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
