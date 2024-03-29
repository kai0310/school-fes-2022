<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Models\User;
use App\UseCase\Auth\CreateUserAction;
use Exception;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class LoginWithGoogleController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')
            ->with(['hd' => config('settings.school.domain')])
            ->redirect();
    }

    public function handleGoogleCallback(CreateUserAction $createUserAction): RedirectResponse
    {
        try {
            $googleAccount = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return to_route('login');
        }

        if (explode('@', $googleAccount->email)[1] !== config('settings.school.domain')) {
            return redirect()->to('/');
        }

        $existingUser = User::where('email', $googleAccount->email)->first();

        if (preg_match('/^\d/', $googleAccount->name)) {
            $prefixCode = (int) substr($googleAccount->name, 0, 5);
            $googleAccount->name = preg_replace('/\d/', '', $googleAccount->name);
        }

        if ($existingUser) {
            auth()->login($existingUser, true);
            return to_route('dashboard');
        }

        $leaders = Leader::pluck('user_email')->toArray();

        if(in_array($googleAccount->email, $leaders)) {
            $user = $createUserAction($googleAccount, $prefixCode);

            auth()->login($user, true);
            return to_route('dashboard');
        }

        return to_route('login');
    }
}
