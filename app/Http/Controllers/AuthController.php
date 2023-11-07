<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    // Отобразить форму входа
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Обработать попытку входа
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Вход успешен
            switch (auth()->user()->role){
                case 'админ':
                    return redirect()->intended('/users');
                    break;
                case 'кухня':
                    return redirect()->intended('/kapplications');
                    break;
                case 'экспедитор':
                    return redirect()->intended('/applications');
                    break;
                case 'старший экспедитор':
                    return redirect()->intended('/applications');
                    break;
                case 'закуп':
                    return redirect()->intended('/purchases');
                    break;
                default:
                    return redirect()->intended('/dashboard');
                    break;
            }
             // Куда перенаправить после успешного входа
        }

        // В случае неудачи перенаправьте обратно на форму входа с сообщением об ошибке
        return redirect()->route('login')->with('error', 'Неверное имя пользователя или пароль.');
    }

    // Выход
    public function logout(Request $request)
    {
        Auth::logout();

        // После выхода перенаправьте пользователя на главную страницу или куда-либо еще
        return redirect('/login');
    }
}
