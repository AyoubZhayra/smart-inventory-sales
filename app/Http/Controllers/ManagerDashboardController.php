<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerDashboardController extends Controller
{
    /**
     * Display the manager dashboard.
     */
    public function index()
    {
        // Check if user is a manager or admin
        if (!Auth::user()->isManager() && !Auth::user()->isAdmin()) {
            return redirect()->route('staff.dashboard');
        }

        return view('dashboard.manager');
    }
} 