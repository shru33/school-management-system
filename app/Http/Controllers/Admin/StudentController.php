<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'classRoom'])->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classes = ClassRoom::all();
        return view('admin.students.create', compact('classes'));
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
            'admission_number' => 'required|unique:students,admission_number',
            'class_id' => 'nullable|exists:classes,id',
            'roll_number' => 'nullable|string',
            'admission_date' => 'required|date',
            'parent_name' => 'required|string',
            'parent_phone' => 'required|string',
            'parent_email' => 'nullable|email'
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'student',
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'date_of_birth' => $validated['date_of_birth']
            ]);

            Student::create([
                'user_id' => $user->id,
                'admission_number' => $validated['admission_number'],
                'class_id' => $validated['class_id'],
                'roll_number' => $validated['roll_number'],
                'admission_date' => $validated['admission_date'],
                'parent_name' => $validated['parent_name'],
                'parent_phone' => $validated['parent_phone'],
                'parent_email' => $validated['parent_email']
            ]);

            DB::commit();
            return redirect()->route('admin.students.index')
                           ->with('success', 'Student created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error creating student: ' . $e->getMessage());
        }
    }

    public function show(Student $student)
    {
        $student->load('user', 'classRoom');
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $student->load('user');
        $classes = ClassRoom::all();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'required|date',
            'admission_number' => 'required|unique:students,admission_number,' . $student->id,
            'class_id' => 'nullable|exists:classes,id',
            'roll_number' => 'nullable|string',
            'admission_date' => 'required|date',
            'parent_name' => 'required|string',
            'parent_phone' => 'required|string',
            'parent_email' => 'nullable|email',
            'status' => 'required|in:active,inactive,graduated'
        ]);

        DB::beginTransaction();
        try {
            $student->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'date_of_birth' => $validated['date_of_birth']
            ]);

            $student->update([
                'admission_number' => $validated['admission_number'],
                'class_id' => $validated['class_id'],
                'roll_number' => $validated['roll_number'],
                'admission_date' => $validated['admission_date'],
                'parent_name' => $validated['parent_name'],
                'parent_phone' => $validated['parent_phone'],
                'parent_email' => $validated['parent_email'],
                'status' => $validated['status']
            ]);

            DB::commit();
            return redirect()->route('admin.students.index')
                           ->with('success', 'Student updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error updating student: ' . $e->getMessage());
        }
    }

    public function destroy(Student $student)
    {
        try {
            $student->user->delete();
            return redirect()->route('admin.students.index')
                           ->with('success', 'Student deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting student: ' . $e->getMessage());
        }
    }
}