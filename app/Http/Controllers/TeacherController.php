<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    // Display all teachers, their classes, and subjects
    public function index()
    {
        $teachers = Teacher::with([
            'schoolClasses',
            'subjects'
        ])->get();

        return view('teachers.index', compact('teachers'));
    }

    // Show Add Teacher form
    public function create()
    {
        $subjects = Subject::all();

        return view('teachers.create', compact('subjects'));
    }

    // Save a new teacher
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'subject_ids' => 'nullable|array',
            'subject_ids.*' => [
                'integer',
                'distinct',
                'exists:subjects,id'
            ],
        ]);

        $subjectIds = $validated['subject_ids'] ?? [];

        unset($validated['subject_ids']);

        $teacher = Teacher::create($validated);

        // Preserve Assign Subjects functionality
        $teacher->subjects()->sync($subjectIds);

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher added successfully!');
    }

    // Display Assign Classes page
    public function assign($id)
    {
        $teacher = Teacher::with('schoolClasses')->findOrFail($id);

        // Load all classes from the database
        $classes = SchoolClass::all();

        return view('teachers.assign', compact('teacher', 'classes'));
    }

    // Save assigned classes
    public function updateAssignments(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $validated = $request->validate([
            'class_ids' => ['nullable', 'array'],
            'class_ids.*' => [
                'integer',
                'distinct',
                'exists:school_classes,id'
            ],
        ]);

        $classIds = $validated['class_ids'] ?? [];

        // Prevent taking classes from another teacher
        $availableIds = SchoolClass::where(function ($query) use ($teacher) {
            $query->whereNull('teacher_id')
                ->orWhere('teacher_id', $teacher->id);
        })
            ->whereIn('id', $classIds)
            ->pluck('id')
            ->all();

        if (count($availableIds) !== count($classIds)) {
            return back()
                ->withErrors([
                    'class_ids' => 'Some selected classes are assigned to another teacher.'
                ])
                ->withInput();
        }

        DB::transaction(function () use ($teacher, $classIds) {
            // Clear this teacher's previous assignments
            SchoolClass::where('teacher_id', $teacher->id)
                ->update(['teacher_id' => null]);

            // Assign the selected classes
            if (!empty($classIds)) {
                SchoolClass::whereIn('id', $classIds)
                    ->update(['teacher_id' => $teacher->id]);
            }
        });

        return redirect()->route('teachers.index')
            ->with('success', 'Classes assigned successfully!');
    }
}
