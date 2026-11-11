<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
{
    public function edit($id)
    {
        $teacher = Teacher::with('subjects')->findOrFail($id);
        $subjects = Subject::orderBy('name')->get();

        return view('teachers.assign-subjects', compact(
            'teacher',
            'subjects'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subjects' => ['nullable', 'array'],
            'subjects.*' => [
                'integer',
                'distinct',
                'exists:subjects,id'
            ],
        ]);

        $teacher = Teacher::findOrFail($id);

        $teacher->subjects()->sync(
            $request->input('subjects', [])
        );

        return redirect()
            ->route('teachers.subjects.edit', $teacher->id)
            ->with('success', 'Subjects assigned successfully!');
    }
}
