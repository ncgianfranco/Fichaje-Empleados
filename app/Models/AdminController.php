<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminController extends Model
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
