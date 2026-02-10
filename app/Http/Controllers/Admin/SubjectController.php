<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::paginate(15);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subjects,code',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1'
        ]);

        Subject::create($validated);

        return redirect()->route('admin.subjects.index')
                       ->with('success', 'Subject created successfully');
    }

    public function show(Subject $subject)
    {
        $subject->load(['classes', 'teachers.user']);
        return view('admin.subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subjects,code,' . $subject->id,
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1'
        ]);

        $subject->update($validated);

        return redirect()->route('admin.subjects.index')
                       ->with('success', 'Subject updated successfully');
    }

    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();
            return redirect()->route('admin.subjects.index')
                           ->with('success', 'Subject deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting subject: ' . $e->getMessage());
        }
    }
}

