<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->paginate(15);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'required|date',
            'employee_id' => 'required|unique:teachers,employee_id',
            'qualification' => 'required|string',
            'joining_date' => 'required|date',
            'specialization' => 'nullable|string',
            'salary' => 'nullable|numeric'
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'teacher',
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'date_of_birth' => $validated['date_of_birth']
            ]);

            Teacher::create([
                'user_id' => $user->id,
                'employee_id' => $validated['employee_id'],
                'qualification' => $validated['qualification'],
                'joining_date' => $validated['joining_date'],
                'specialization' => $validated['specialization'],
                'salary' => $validated['salary']
            ]);

            DB::commit();
            return redirect()->route('admin.teachers.index')
                           ->with('success', 'Teacher created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error creating teacher: ' . $e->getMessage());
        }
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('user', 'subjects', 'classRooms');
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load('user');
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'required|date',
            'employee_id' => 'required|unique:teachers,employee_id,' . $teacher->id,
            'qualification' => 'required|string',
            'joining_date' => 'required|date',
            'specialization' => 'nullable|string',
            'salary' => 'nullable|numeric',
            'status' => 'required|in:active,inactive,on_leave'
        ]);

        DB::beginTransaction();
        try {
            $teacher->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'date_of_birth' => $validated['date_of_birth']
            ]);

            $teacher->update([
                'employee_id' => $validated['employee_id'],
                'qualification' => $validated['qualification'],
                'joining_date' => $validated['joining_date'],
                'specialization' => $validated['specialization'],
                'salary' => $validated['salary'],
                'status' => $validated['status']
            ]);

            DB::commit();
            return redirect()->route('admin.teachers.index')
                           ->with('success', 'Teacher updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error updating teacher: ' . $e->getMessage());
        }
    }

    public function destroy(Teacher $teacher)
    {
        try {
            $teacher->user->delete(); // This will cascade delete the teacher
            return redirect()->route('admin.teachers.index')
                           ->with('success', 'Teacher deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting teacher: ' . $e->getMessage());
        }
    }
}