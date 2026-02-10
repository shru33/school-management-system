<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Student Details') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.students.edit', $student) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                <a href="{{ route('admin.students.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to List</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Profile Card --}}
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="text-center">
                                <div class="mx-auto h-32 w-32 rounded-full bg-blue-300 flex items-center justify-center mb-4">
                                    @if($student->user->avatar)
                                        <img src="{{ asset('storage/' . $student->user->avatar) }}" 
                                             alt="{{ $student->user->name }}" 
                                             class="h-32 w-32 rounded-full object-cover">
                                    @else
                                        <span class="text-5xl text-blue-600 font-bold">
                                            {{ substr($student->user->name, 0, 1) }}
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $student->user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $student->admission_number }}</p>
                                
                                <div class="mt-4">
                                    @if($student->status === 'active')
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    @elseif($student->status === 'inactive')
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Graduated</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6 space-y-4">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Email</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $student->user->email }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Phone</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $student->user->phone ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Date of Birth</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $student->user->date_of_birth ? $student->user->date_of_birth->format('F d, Y') : 'N/A' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Address</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $student->user->address ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Details --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Academic Information --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Academic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Admission Number</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $student->admission_number }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Class</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $student->classRoom?->name ?? 'Not Assigned' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Roll Number</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $student->roll_number ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Admission Date</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $student->admission_date ? $student->admission_date->format('F d, Y') : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Parent Information --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Parent/Guardian Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Name</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $student->parent_name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Phone</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $student->parent_phone }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-xs text-gray-500 uppercase">Email</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $student->parent_email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                            <div class="flex gap-4">
                                <a href="{{ route('admin.students.edit', $student) }}" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit Student</a>
                                <form action="{{ route('admin.students.destroy', $student) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete Student</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>