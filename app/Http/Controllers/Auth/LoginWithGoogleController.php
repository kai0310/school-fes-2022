<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class LoginWithGoogleController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')
            ->with(['hd' => config('app.school_domain')])
            ->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleAccount = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('/login');
        }

        if (explode('@', $googleAccount->email)[1] !== config('app.school_domain')) {
            return redirect()->to('/');
        }

        $existingUser = User::where('email', $googleAccount->email)->first();

        if (preg_match('/^\d/', $googleAccount->name)) {
            $prefixCode = (int) substr($googleAccount->name, 0, 5);
            $googleAccount->name = preg_replace('/\d/', '', $googleAccount->name);
        }

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $user = User::create([
                'name' => $googleAccount->name,
                'email' => $googleAccount->email,
                'google_id' => $googleAccount->id,
                'profile_photo_path' => $googleAccount->avatar,
            ]);

            if ($prefixCode) {
                $alphabet = range('A', 'Z');

                $jr_high_school_student = substr($prefixCode, 0, 1) < 4;
                $user->schoolClass()->create([
                    'organization' => $jr_high_school_student ? 0 : 1,
                    'grade' => $jr_high_school_student ? substr($prefixCode, 0, 1) : substr($prefixCode, 0, 1) - 3,
                    'class' => $jr_high_school_student ? mb_substr($prefixCode, 1, 2) : $alphabet[((int) mb_substr($prefixCode, 1, 2)) - 1],
                    'class_number' => substr($prefixCode, 3, 2),
                ]);
            }

            $user->assignRole($prefixCode ? 'student' : 'teacher');

            auth()->login($user, true);
        }

        return redirect()->route('dashboard');
    }
}
