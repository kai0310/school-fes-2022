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
        'school_class_id',
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
        'type' => ClassProjectType::class
    ];

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function isAttraction(): bool
    {
        return $this->type === ClassProjectType::Attraction;
    }
}
