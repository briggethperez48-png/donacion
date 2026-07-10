<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('users.loginUser');
    }
    
    public function login(Request $request) {
    $this->validate($request, [
        'login'    => 'required|string',
        'password' => 'required'
    ]);

    // Respetamos mayúsculas/minúsculas tal cual lo escribió el usuario, solo quitamos espacios extra
    $loginInput = trim($request->input('login'));

    // Detectamos si es un correo o el nombre de usuario (login)
    $campoAutenticacion = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

    // Preparamos las credenciales con el valor exacto escrito en el formulario
    $credentials = [
        $campoAutenticacion => $loginInput,
        'password'          => $request->input('password'),
    ];

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Conservamos la validación del booleano nativo directamente en PHP
        if (!$user->activo) {
            Auth::logout();
            return back()->withErrors([
                'login' => 'Esta cuenta se encuentra desactivada o inactiva.',
            ])->withInput($request->only('login'));
        }
        
        $request->session()->regenerate();
        
        return redirect()->intended('/content'); 
    }

    return back()->withErrors([
        'login' => 'Las credenciales no coinciden con nuestros registros.',
    ])->withInput($request->only('login'));
}
    public function logout(Request $request)
    {
        // 1. Cierra la sesión del usuario
        Auth::logout();

        // 2. Invalida la sesión actual para borrar los datos guardados
        $request->session()->invalidate();

        // 3. Regenera el token de seguridad CSRF
        $request->session()->regenerateToken();

        // 4. Redirige a la pantalla principal o al login
        return redirect('/login'); 
    }
}