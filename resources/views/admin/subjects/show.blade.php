<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $subject->name }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.subjects.edit', $subject) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                <a href="{{ route('admin.subjects.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Subject Info --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Subject Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Subject Code</p>
                            <p class="text-lg font-medium">{{ $subject->code }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Subject Name</p>
                            <p class="text-lg font-medium">{{ $subject->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Credits</p>
                            <p class="text-lg font-medium">{{ $subject->credits }}</p>
                        </div>
                        <div class="md:col-span-3">
                            <p class="text-xs text-gray-500 uppercase">Description</p>
                            <p class="text-sm text-gray-700">{{ $subject->description ?? 'No description available' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Assigned Classes --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Assigned to Classes</h3>
                    @if($subject->classes->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($subject->classes as $class)
                                <div class="border rounded-lg p-4">
                                    <h4 class="font-semibold">{{ $class->name }}</h4>
                                    <p class="text-sm text-gray-500">Grade {{ $class->grade }} - Section {{ $class->section }}</p>
                                    <p class="text-xs text-gray-400">Students: {{ $class->students_count ?? 0 }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Not assigned to any class yet.</p>
                    @endif
                </div>
            </div>

            {{-- Assigned Teachers --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Assigned Teachers</h3>
                    @if($subject->teachers->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($subject->teachers as $teacher)
                                <div class="border rounded-lg p-4 flex items-center">
                                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                        <span class="text-green-600 font-semibold text-lg">{{ substr($teacher->user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">{{ $teacher->user->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $teacher->employee_id }}</p>
                                        <p class="text-xs text-gray-400">{{ $teacher->specialization ?? 'No specialization' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No teachers assigned yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>