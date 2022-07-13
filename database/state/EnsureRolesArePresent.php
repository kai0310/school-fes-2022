<?php

namespace Database\State;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class EnsureRolesArePresent
{
    public function __invoke()
    {
        if ($this->present() && Schema::hasTable('roles')) {
            return;
        }

        $roles = [
            'teacher',
            'student',
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }
    }

    public function present(): bool
    {
        return DB::table('roles')->count() > 0;
    }
}
