<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'birth_date',
    ];

    // One-to-One: Student has one profile
    public function profile(): HasOne
    {
        return $this->hasOne(StudentProfile::class);
    }

    // Many-to-Many: Student belongs to many school classes
    public function schoolClasses(): BelongsToMany
    {
        return $this->belongsToMany(SchoolClass::class)
                    ->withTimestamps();
    }
}
