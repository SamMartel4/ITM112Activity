<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('teacher')->latest()->get();

        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        $teachers = Teacher::all();

        return view('subjects.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subjects,code',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        Subject::create($validated);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject added successfully!');
    }

    public function show(Subject $subject)
    {
        $subject->load('teacher');

        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $teachers = Teacher::all();

        return view('subjects.edit', compact('subject', 'teachers'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subjects,code,' . $subject->id,
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $subject->update($validated);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject updated successfully!');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject deleted successfully!');
    }
}
