<?php

/** @noinspection ALL */

namespace App\UseCase\Auth;

use App\Models\SchoolClass;
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
        if ($prefixCode) {
            $assignClass = $this->createSchoolClass($prefixCode);
        }

        $user = User::create([
            'name' => $googleAccount->name,
            'email' => $googleAccount->email,
            'google_id' => $googleAccount->id,
            'profile_photo_path' => $googleAccount->avatar,
            'school_class_id' => $assignClass ? $assignClass->id : null,
        ]);

        $user->assignRole($prefixCode ? 'student' : 'teacher');

        return $user;
    }

    /**
     * @param  User  $user
     * @param  int  $prefixCode
     * @return void
     */
    protected function createSchoolClass(int $prefixCode)
    {
        $alphabet = range('A', 'Z');

        $jr_high_school_student = substr($prefixCode, 0, 1) < 4;

        $class = SchoolClass::firstOrCreate([
            'code' => $prefixCode,

            'organization' => $jr_high_school_student ? 0 : 1,

            'grade' => $jr_high_school_student
                ? substr($prefixCode, 0, 1)
                : substr($prefixCode, 0, 1) - 3,

            'class' => $jr_high_school_student
                ? substr($prefixCode, 1, 2)
                : $alphabet[((int) substr($prefixCode, 1, 2)) - 1],
        ]);

        return $class;
    }
}
