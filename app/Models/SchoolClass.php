<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization',
        'grade',
        'class',
        'class_number',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function classProject(): HasOne
    {
        return $this->hasOne(ClassProject::class);
    }
}
