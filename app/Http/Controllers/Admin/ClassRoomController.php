<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoom;
use App\Models\Teacher;

class ClassRoomController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::with(['classTeacher.user', 'students'])
            ->withCount('students')
            ->paginate(15);
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $teachers = Teacher::with('user')->get();
        return view('admin.classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'grade' => 'required|string|max:50',
            'section' => 'required|string|max:10',
            'class_teacher_id' => 'nullable|exists:teachers,id',
            'capacity' => 'required|integer|min:1',
            'room_number' => 'nullable|string|max:50'
        ]);

        ClassRoom::create($validated);

        return redirect()->route('admin.classes.index')
                       ->with('success', 'Class created successfully');
    }

    public function show(ClassRoom $class)
    {
        
        $class->load(['classTeacher.user', 'students.user', 'subjects']);
        return view('admin.classes.show', compact('class'));
    }

    public function edit(ClassRoom $class)
    {
        $teachers = Teacher::with('user')->get();
        return view('admin.classes.edit', compact('class', 'teachers'));
    }

    public function update(Request $request, ClassRoom $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'grade' => 'required|string|max:50',
            'section' => 'required|string|max:10',
            'class_teacher_id' => 'nullable|exists:teachers,id',
            'capacity' => 'required|integer|min:1',
            'room_number' => 'nullable|string|max:50'
        ]);

        $class->update($validated);

        return redirect()->route('admin.classes.index')
                       ->with('success', 'Class updated successfully');
    }

    public function destroy(ClassRoom $class)
    {
        try {
            $class->delete();
            return redirect()->route('admin.classes.index')
                           ->with('success', 'Class deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting class: ' . $e->getMessage());
        }
    }
}
