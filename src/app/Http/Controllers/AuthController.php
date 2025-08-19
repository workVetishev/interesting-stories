<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Показ формы регистрации
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Регистрация пользователя
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // по умолчанию обычный пользователь
        ]);

        Auth::login($user); // автоматически входим после регистрации

        return redirect('/')->with('success', 'Вы успешно зарегистрированы!');
    }

    // Показ формы входа
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Вход пользователя
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect('/')->with('success', 'Добро пожаловать!');
        }

        return back()->withErrors(['email' => 'Неверные данные.']);
    }

    // Выход
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Вы вышли из аккаунта.');
    }
}