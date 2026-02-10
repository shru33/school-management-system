<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Students -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">Total Students</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalStudents ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Teachers -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">Total Teachers</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalTeachers ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Classes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">Total Classes</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalClasses ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Subjects -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">Total Subjects</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalSubjects ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Students -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Students</h3>
                        @if(isset($recentStudents) && $recentStudents->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentStudents as $student)
                                    <div class="flex items-center justify-between border-b pb-3">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-blue-600 font-semibold">{{ substr($student->user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">{{ $student->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $student->admission_number }}</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $student->created_at->diffForHumans() }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.students.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                                    View all students →
                                </a>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No students found.</p>
                        @endif
                    </div>
                </div>

                <!-- Recent Teachers -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Teachers</h3>
                        @if(isset($recentTeachers) && $recentTeachers->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentTeachers as $teacher)
                                    <div class="flex items-center justify-between border-b pb-3">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <span class="text-green-600 font-semibold">{{ substr($teacher->user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">{{ $teacher->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $teacher->employee_id }}</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $teacher->created_at->diffForHumans() }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.teachers.index') }}" class="text-sm text-green-600 hover:text-green-800">
                                    View all teachers →
                                </a>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No teachers found.</p>
                        @endif
                    </div>
                </div>

                <!-- Recent Teachers -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Classes</h3>
                        @if(isset($recentClasses) && $recentClasses->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentClasses as $class)
                                    <div class="flex items-center justify-between border-b pb-3">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-blue-600 font-semibold">{{ substr($class->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">{{ $class->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $class->grade }} - {{ $class->section }}</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $class->created_at->diffForHumans() }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.classes.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                                    View all classes →
                                </a>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No teachers found.</p>
                        @endif
                    </div>
                </div>
                
                <!-- Recent Subjects -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Subjects</h3>
                        @if(isset($recentSubjects) && $recentSubjects->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentSubjects as $subject)
                                    <div class="flex items-center justify-between border-b pb-3">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-blue-600 font-semibold">{{ substr($subject->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">{{ $subject->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $subject->code }}</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $subject->created_at->diffForHumans() }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.subjects.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                                    View all subjects →
                                </a>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No subjects found.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('admin.students.create') }}" class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                            <svg class="w-8 h-8 text-blue-600 mb-2 w-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Add Student</span>
                        </a>
                        <a href="{{ route('admin.teachers.create') }}" class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                            <svg class="w-8 h-8 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Add Teacher</span>
                        </a>
                        <a href="{{ route('admin.classes.create') }}" class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                            <svg class="w-8 h-8 text-yellow-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Add Class</span>
                        </a>
                        <a href="{{ route('admin.subjects.create') }}" class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                            <svg class="w-8 h-8 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Add Subject</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-6 text-center text-gray-500 ">
                &copy; <a href="#" class="w-30">{{ date('Y') }}</a> School Management System. All rights reserved.
            </div>    
        </div>
    </div>
</x-app-layout>