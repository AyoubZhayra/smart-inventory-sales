<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffDashboardController extends Controller
{
    /**
     * Display the staff dashboard.
     */
    public function index()
    {
        return view('dashboard.staff');
    }
} 