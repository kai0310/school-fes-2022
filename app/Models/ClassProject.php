<?php

namespace App\Models;

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
        'vision',
        'place',
        'type',
        'consumption_provision',
        'paid_planning',
    ];

    protected $casts = [
        'consumption_provision' => 'boolean',
        'paid_planning' => 'boolean',
    ];

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
