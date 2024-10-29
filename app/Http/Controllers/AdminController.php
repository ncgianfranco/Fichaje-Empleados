<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Admin-specific logic and data
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        // Logic to manage employees
        return view('admin.manageUsers');
    }
}
