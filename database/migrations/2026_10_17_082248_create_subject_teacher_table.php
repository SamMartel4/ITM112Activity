<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->id();

            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->cascadeOnDelete();

            $table->unique(['subject_id', 'teacher_id']);
            $table->timestamps();
        });

        // Preserve existing subject-teacher assignments
        DB::table('subjects')
            ->whereNotNull('teacher_id')
            ->orderBy('id')
            ->get(['id', 'teacher_id'])
            ->each(function ($subject) {
        DB::table('subject_teacher')->insertOrIgnore([
                    'subject_id' => $subject->id,
                    'teacher_id' => $subject->teacher_id,
                    'created_at' => now(),
                    'updated_at' => now(),
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_teacher');
    }
};
