<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password'); // Vista para ingresar el email
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Enviar el enlace para restablecer la contraseña
        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', 'Se ha enviado un enlace de restablecimiento de contraseña.');
        }

        return back()->withErrors(['email' => 'No encontramos una cuenta con ese correo electrónico.']);
    }
}
