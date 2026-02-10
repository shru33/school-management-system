<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Classes Management') }}</h2>
            <a href="{{ route('admin.classes.create') }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New Class</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($classes as $class)
                            <div class="border rounded-lg p-6 hover:shadow-lg transition">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">{{ $class->name }}</h3>
                                        <p class="text-sm text-gray-500">Grade {{ $class->grade }} - Section {{ $class->section }}</p>
                                    </div>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                        {{ $class->students_count ?? 0 }}/{{ $class->capacity }}
                                    </span>
                                </div>

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="text-gray-700">
                                            Teacher: {{ $class->classTeacher?->user->name ?? 'Not Assigned' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        <span class="text-gray-700">Room: {{ $class->room_number ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('admin.classes.show', $class) }}" 
                                       class="flex-1 text-center bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-3 rounded">
                                        View
                                    </a>
                                    <a href="{{ route('admin.classes.edit', $class) }}" 
                                       class="flex-1 text-center bg-gray-500 hover:bg-gray-700 text-white text-sm font-bold py-2 px-3 rounded">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-12">
                                <p class="text-gray-500">No classes found. <a href="{{ route('admin.classes.create') }}" class="text-blue-600 hover:underline">Add your first class</a></p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $classes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>