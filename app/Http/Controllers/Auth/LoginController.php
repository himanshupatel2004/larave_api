<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserValidate;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function manualLogin(UserValidate $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if ($user) {
            $hashedPassword = $user->password;
            if (Hash::check($password, $hashedPassword)) {
                Auth::login($user);
                return redirect('user/list');
            } else {
                dd("Password Not Match");
            }
        } else {
            dd("User Not Found");
        }
    }

    public function login(Request $request)
    {
        // dd(www);
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();

            return redirect('user/list')->with('success', 'User Login Successfully.');
            // return redirect('home')->with('success', 'User Login Successfully.');

        }
        return redirect()->back()->with('error', 'Credencial Not Match');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}