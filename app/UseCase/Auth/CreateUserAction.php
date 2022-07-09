<?php

/** @noinspection ALL */

namespace App\UseCase\Auth;

use App\Models\User;
use Laravel\Socialite\Two\User as SocialiteUser;

class CreateUserAction
{
    /**
     * @param  array  $googleAccount
     * @param  int  $prefixCode
     * @return User
     */
    public function __invoke(SocialiteUser $googleAccount, int $prefixCode): User
    {
        $user = User::create([
            'name' => $googleAccount->name,
            'email' => $googleAccount->email,
            'google_id' => $googleAccount->id,
            'profile_photo_path' => $googleAccount->avatar,
        ]);

        $user->assignRole($prefixCode ? 'student' : 'teacher');

        if ($prefixCode) {
            $this->assignSchoolClass($user, $prefixCode);
        }

        return $user;
    }

    /**
     * @param  User  $user
     * @param  int  $prefixCode
     * @return void
     */
    protected function assignSchoolClass(User $user, int $prefixCode)
    {
        $alphabet = range('A', 'Z');

        $jr_high_school_student = substr($prefixCode, 0, 1) < 4;

        $user->schoolClass()->create([
            'organization' => $jr_high_school_student ? 0 : 1,

            'grade' => $jr_high_school_student
                ? substr($prefixCode, 0, 1)
                : substr($prefixCode, 0, 1) - 3,

            'class' => $jr_high_school_student
                ? substr($prefixCode, 1, 2)
                : $alphabet[((int) substr($prefixCode, 1, 2)) - 1],

            'class_number' => substr($prefixCode, 3, 2),
        ]);
    }
}
