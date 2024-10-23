<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeController extends Model
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
