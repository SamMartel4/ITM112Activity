<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SchoolClass extends Model
{
    protected $fillable = [
        'section_name',
        'teacher_id',
    ];

    // A class belongs to one teacher
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    // A class can have many students
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class)
                    ->withTimestamps();
    }
}
