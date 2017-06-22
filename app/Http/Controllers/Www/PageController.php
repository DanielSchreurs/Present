<?php

namespace App\Http\Controllers\Www;

use Barryvdh\Debugbar\DataCollector\AuthCollector;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    public function getConfig()
    {
        return view('configuration.config');
    }
}
