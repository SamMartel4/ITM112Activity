<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('school_classes', 'teacher_id')) {
            Schema::table('school_classes', function (Blueprint $table) {
                $table->foreignId('teacher_id')
                    ->nullable()
                    ->constrained('teachers')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Keep existing teacher_id and assigned data.
    }
};