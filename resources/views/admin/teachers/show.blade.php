<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Teacher Details') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.teachers.edit', $teacher) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('admin.teachers.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Left Column - Profile Card --}}
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="text-center">
                                <div class="mx-auto h-32 w-32 rounded-full bg-gray-300 flex items-center justify-center mb-4">
                                    @if($teacher->user->avatar)
                                        <img src="{{ asset('storage/' . $teacher->user->avatar) }}" 
                                             alt="{{ $teacher->user->name }}" 
                                             class="h-32 w-32 rounded-full object-cover">
                                    @else
                                        <span class="text-5xl text-gray-600 font-bold">
                                            {{ substr($teacher->user->name, 0, 1) }}
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $teacher->user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $teacher->employee_id }}</p>
                                
                                <div class="mt-4">
                                    @if($teacher->status === 'active')
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @elseif($teacher->status === 'inactive')
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactive
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            On Leave
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6 space-y-4">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Email</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $teacher->user->email }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Phone</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $teacher->user->phone ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Date of Birth</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $teacher->user->date_of_birth ? $teacher->user->date_of_birth->format('F d, Y') : 'N/A' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Address</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $teacher->user->address ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column - Details --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Employment Information --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Employment Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Employee ID</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $teacher->employee_id }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Qualification</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $teacher->qualification }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Joining Date</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $teacher->joining_date ? $teacher->joining_date->format('F d, Y') : 'N/A' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Experience</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $teacher->joining_date ? $teacher->joining_date->diffForHumans(now(), true) : 'N/A' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Specialization</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $teacher->specialization ?? 'N/A' }}</p>
                                </div>
                                @if($teacher->salary)
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase">Salary</p>
                                        <p class="text-sm font-medium text-gray-900">${{ number_format($teacher->salary, 2) }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Assigned Classes --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Assigned Classes</h3>
                            @if($teacher->classRooms && $teacher->classRooms->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($teacher->classRooms as $class)
                                        <div class="border rounded-lg p-4 hover:bg-gray-50">
                                            <p class="font-semibold text-gray-900">{{ $class->name }}</p>
                                            <p class="text-sm text-gray-500">Grade {{ $class->grade }} - Section {{ $class->section }}</p>
                                            <p class="text-xs text-gray-400 mt-1">Room: {{ $class->room_number ?? 'N/A' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No classes assigned yet.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Assigned Subjects --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Assigned Subjects</h3>
                            @if($teacher->subjects && $teacher->subjects->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Credits</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($teacher->subjects as $subject)
                                                <tr>
                                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $subject->name }}</td>
                                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $subject->code }}</td>
                                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $subject->credits }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No subjects assigned yet.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                            <div class="flex gap-4">
                                <a href="{{ route('admin.teachers.edit', $teacher) }}" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Edit Teacher
                                </a>
                                <form action="{{ route('admin.teachers.destroy', $teacher) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this teacher? This action cannot be undone.');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Delete Teacher
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>