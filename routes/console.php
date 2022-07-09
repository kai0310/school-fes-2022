<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('ensure-database-state-is-loaded', function () {
    collect([
        new Database\State\EnsureRolesArePresent,
    ])->each->__invoke();
});
