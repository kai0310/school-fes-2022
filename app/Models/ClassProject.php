<?php

namespace App\Models;

use App\Enums\ClassProjectType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_class_code',
        'name',
        'detail',
        'place',
        'type',
        'provide_meals',
        'paid_planning',
        'infection_control',
    ];

    protected $casts = [
        'provide_meals' => 'boolean',
        'paid_planning' => 'boolean',
    ];

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class,
            'school_class_code',
            'code'
        );
    }

    public function isAttraction(): bool
    {
        return $this->type === ClassProjectType::Attraction;
    }
}
