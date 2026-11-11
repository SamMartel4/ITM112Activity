<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'code',
       
    ];

    // Relationship: Subject belongs to one teacher
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    // Relationship: Subject can have many teachers
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class);
    }
}

