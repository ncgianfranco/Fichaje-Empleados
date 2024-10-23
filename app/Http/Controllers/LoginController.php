<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

     // Show the login form
    public function show() 
    {
        return view('login'); // returns the login form view
    }

    // Handle the login request
    public function login(Request $request)
    {
        // validate the form imput
        $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        // Attempt login
        if (!Auth::attempt(['email' => $request->email, 'password'=> $request->password])) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.'
            ]);
        }

        // If login is successful enviamos peticion http a dashboard con método get
        return redirect()->intended('dashboard');

    }

    // Handle the logout request
    public function logout(Request $request)
    {
        Auth::logout(); // logs the user out

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('login'); //redirect back to login page
    }
}
