<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Models\Subject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalClasses = ClassRoom::count();
        $totalSubjects = Subject::count();

        // Get recent students (last 5)
        $recentStudents = Student::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Get recent teachers (last 5)
        $recentTeachers = Teacher::with('user')
            ->latest()
            ->take(5)
            ->get();

        $recentClasses = ClassRoom::latest()
            ->take(3)
            ->get();

        // Get recent teachers (last 5)
        $recentSubjects = Subject::latest()
            ->take(3)
            ->get();            

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalClasses',
            'totalSubjects',
            'recentStudents',
            'recentTeachers',
            'recentClasses',
            'recentSubjects'
        ));
    }
}