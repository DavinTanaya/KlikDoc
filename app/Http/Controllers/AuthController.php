<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmailMail;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|string|max:15|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        // Hapus token lama (jaga-jaga)
        UserToken::where('user_id', $user->id)
            ->where('type', 'verify')
            ->delete();

        $token = Str::uuid()->toString();

        UserToken::create([
            'user_id' => $user->id,
            'token' => $token,
            'type' => 'verify',
            'expired_at' => Carbon::now()->addMinutes(30),
        ]);

        // kirim email
        Mail::to($user->email)->send(
            new VerifyEmailMail($token)
        );

        return response()->json([
            'message' => 'Registration success. Please verify your email.'
        ], 201);
    }
    
    public function getLogin(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            Auth::setRememberDuration(120);

            if (Auth::user()->email_verified_at === null) {
                Auth::logout();

                return redirect()
                    ->route('auth.verify.notice', ['email' => $request->email]);
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'message' => 'Invalid credentials'
        ]);
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

            $user->email_verified_at = now();
            $user->save();

            Auth::login($user);
            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['message' => 'Authentication failed']);
        }
    }

    public function forgot() {
        return view('auth.forgot');
    }
    public function resetForm($token)
    {
        $userToken = UserToken::where('token', $token)
            ->where('type', 'reset')
            ->where('expired_at', '>', now())
            ->first();

        abort_if(! $userToken, 404);

        return view('auth.new-password', [
            'token' => $token
        ]);
    }

    public function verifyEmail($token)
    {
        $userToken = UserToken::where('token', $token)
            ->where('type', 'verify')
            ->first();

        if (!$userToken || $userToken->expired_at < now()) {
            return redirect()
                ->route('login')
                ->with('error', 'Link verifikasi tidak valid atau sudah expired.');
        }

        $user = $userToken->user;

        $user->email_verified_at = now();
        $user->save();

        $userToken->delete();
        
        Auth::login($user);
        return redirect()
            ->route('home')
            ->with('success', 'Email berhasil diverifikasi.');
    }

    public function verifyNotice($email)
    {
        return view('auth.verify-notice', ['email' => $email]);
    }

    public function resendVerification(Request $request)
    {
        $user = User::where('email', $request->email)
            ->whereNull('email_verified_at')
            ->firstOrFail();

        UserToken::where('user_id', $user->id)
            ->where('type', 'verify')
            ->delete();

        $token = Str::uuid()->toString();

        UserToken::create([
            'user_id' => $user->id,
            'token' => $token,
            'type' => 'verify',
            'expired_at' => now()->addMinutes(30),
        ]);

        Mail::to($user->email)->send(
            new VerifyEmailMail($token)
        );

        return back()->with('success', 'Email verifikasi dikirim ulang.');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        // hapus token reset lama
        UserToken::where('user_id', $user->id)
            ->where('type', 'reset')
            ->delete();

        $token = Str::uuid()->toString();

        UserToken::create([
            'user_id' => $user->id,
            'token' => $token,
            'type' => 'reset',
            'expired_at' => Carbon::now()->addMinutes(15),
        ]);

        Mail::to($user->email)->send(
            new ResetPasswordMail($token)
        );

        return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $userToken = UserToken::where('token', $request->token)
            ->where('type', 'reset')
            ->firstOrFail();

        if ($userToken->expired_at < now()) {
            return redirect()->route('login')
                ->with('error', 'Token reset password telah kedaluwarsa.');
        }

        $user = $userToken->user;
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $userToken->delete();

        return redirect()
            ->route('login')
            ->with('success', 'Password berhasil direset. Silakan login.');
    }

}
