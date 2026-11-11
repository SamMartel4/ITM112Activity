<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
    ];

    // Many-to-Many: Teacher <-> Subjects
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }

    // One-to-Many: Teacher -> SchoolClasses
    public function schoolClasses(): HasMany
    {
        return $this->hasMany(SchoolClass::class);
    }
}

