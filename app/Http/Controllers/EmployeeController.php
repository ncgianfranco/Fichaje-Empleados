<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        // Employee-specific logic and data
        return view('employee.dashboard');
    }

    public function viewTimesheet()
    {
        // Logic to view employee timesheet
        return view('employee.timesheet');
    }
}
