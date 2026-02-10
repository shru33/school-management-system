<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $class->name }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.classes.edit', $class) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                <a href="{{ route('admin.classes.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Class Info --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Class Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Grade</p>
                            <p class="text-lg font-medium">{{ $class->grade }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Section</p>
                            <p class="text-lg font-medium">{{ $class->section }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Room Number</p>
                            <p class="text-lg font-medium">{{ $class->room_number ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Capacity</p>
                            <p class="text-lg font-medium">{{ $class->capacity }} students</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Current Enrollment</p>
                            <p class="text-lg font-medium">{{ $class->students->count() }} students</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Class Teacher</p>
                            <p class="text-lg font-medium">{{ $class->classTeacher?->user->name ?? 'Not Assigned' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Students List --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Students in this Class</h3>
                    @if($class->students->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Roll No.</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Admission No.</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($class->students as $student)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $student->roll_number ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $student->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $student->admission_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $student->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ ucfirst($student->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <a href="{{ route('admin.students.show', $student) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">No students in this class yet.</p>
                    @endif
                </div>
            </div>

            {{-- Subjects --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Subjects</h3>
                    @if($class->subjects->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($class->subjects as $subject)
                                <div class="border rounded p-4">
                                    <h4 class="font-semibold">{{ $subject->name }}</h4>
                                    <p class="text-sm text-gray-500">Code: {{ $subject->code }}</p>
                                    <p class="text-xs text-gray-400">Credits: {{ $subject->credits }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No subjects assigned yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>