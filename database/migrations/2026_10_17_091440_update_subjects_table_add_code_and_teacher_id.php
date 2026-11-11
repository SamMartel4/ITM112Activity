<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('subjects', 'code')) {
            throw new RuntimeException(
                'The subjects table is missing the code column.'
            );
        }

        if (!Schema::hasColumn('subjects', 'teacher_id')) {
            throw new RuntimeException(
                'The subjects table is missing the teacher_id column.'
            );
        }
    }

    public function down(): void
    {
        // Keep existing subject columns intact.
    }
};
