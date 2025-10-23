<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // Facebook Social Login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $findUser = User::where('provider_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider' => 'facebook',
                    'provider_id' => $user->id,
                    'password' => Hash::make('password'), // Dummy password
                ]);
                Auth::login($newUser);
            }

            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Facebook login failed']);
        }
    }

    // Google Social Login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('provider_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider' => 'google',
                    'provider_id' => $user->id,
                    'password' => Hash::make('password'), // Dummy password
                ]);
                Auth::login($newUser);
            }

            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Google login failed']);
        }
    }
}
