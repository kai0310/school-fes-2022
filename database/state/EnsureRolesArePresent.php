<?php

namespace Database\State;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class EnsureRolesArePresent
{
    public function __invoke()
    {
        if ($this->present() && Schema::hasTable('permissions')) {
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
        return DB::table('permissions')->count() > 0;
    }
}
