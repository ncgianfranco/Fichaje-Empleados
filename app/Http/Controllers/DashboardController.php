<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        
        if (Auth::user()->role === 'admin') {
            return view('admin.dashboard'); // Admin dashboard
        } else if(Auth::user()->role === 'employee') {
            return view('employee.dashboard'); // Employee dashboard
        }else{
            return abort(403); // Unauthorized access
        }
    
       
        
    }
}
