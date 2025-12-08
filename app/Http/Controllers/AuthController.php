<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);
        
        Auth::login($user);
        return redirect()->route('home');
    }
    
    public function getLogin(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)){
            Auth::setRememberDuration(120);
            return redirect()->intended(route('home'));
        }
        return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
    }

    public function logout()
    {   
        Auth::logout();
        return redirect()->route('login');
    }

    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        try{
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrNew(['email' => $googleUser->getEmail()]);

            if (!$user->exists) {
                $user->name      = $googleUser->getName();
                $user->google_id = $googleUser->getId();
                $user->save();
            } elseif (!$user->google_id) {
                $user->google_id = $googleUser->getId();
                $user->save();
            }

            Auth::login($user);
            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['message' => 'Authentication failed']);
        }
    }

    public function forgot() {
        return view('auth.forgot');
    }

    public function newPassword() {
        return view('auth.new-password');
    }

    // public function handleGoogleCallback(): RedirectResponse
    // {
    //     try {
    //         $googleUser = Socialite::driver('google')->user();

    //         $user = User::firstOrNew(['email' => $googleUser->getEmail()]);

    //         if (!$user->exists) {
    //             $user->name      = $googleUser->getName();
    //             $user->google_id = $googleUser->getId();
    //             $user->save();
    //         } elseif (!$user->google_id) {
    //             $user->google_id = $googleUser->getId();
    //             $user->save();
    //         }

    //         $token = JWTAuth::fromUser($user);

    //         $encryptionKey = Key::loadFromAsciiSafeString(config('app.encryption_key'));
    //         $token = Crypto::encrypt($token, $encryptionKey);

    //         $frontendUrl = 'http://localhost:5173';

    //         return redirect()->away(
    //             $frontendUrl . '/auth/google/success?token=' . $token
    //         );
    //     } catch (\Exception $e) {
    //         $frontendUrl = 'http://localhost:5173';
    //         return redirect()->away(
    //             $frontendUrl . '/auth/google/error?message=' . urlencode('Authentication failed')
    //         );
    //     }
    // }
}
