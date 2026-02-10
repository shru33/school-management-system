<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Student') }}
            </h2>
            <a href="{{ route('admin.students.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <strong class="font-bold">Whoops!</strong>
                            <span class="block sm:inline">There were some problems with your input.</span>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.students.update', $student) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Personal Information Section --}}
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Personal Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" 
                                           value="{{ old('name', $student->user->name) }}" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" 
                                           value="{{ old('email', $student->user->email) }}" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <input type="text" name="phone" id="phone" 
                                           value="{{ old('phone', $student->user->phone) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                <div>
                                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">
                                        Date of Birth <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" 
                                           value="{{ old('date_of_birth', $student->user->date_of_birth?->format('Y-m-d')) }}" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <textarea name="address" id="address" rows="3"
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('address', $student->user->address) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Academic Information Section --}}
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Academic Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="admission_number" class="block text-sm font-medium text-gray-700">
                                        Admission Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="admission_number" id="admission_number" 
                                           value="{{ old('admission_number', $student->admission_number) }}" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                <div>
                                    <label for="admission_date" class="block text-sm font-medium text-gray-700">
                                        Admission Date <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="admission_date" id="admission_date" 
                                           value="{{ old('admission_date', $student->admission_date?->format('Y-m-d')) }}" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                <div>
                                    <label for="class_id" class="block text-sm font-medium text-gray-700">Class</label>
                                    <select name="class_id" id="class_id"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                        <option value="">Select Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}" 
                                                    {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="roll_number" class="block text-sm font-medium text-gray-700">Roll Number</label>
                                    <input type="text" name="roll_number" id="roll_number" 
                                           value="{{ old('roll_number', $student->roll_number) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select name="status" id="status" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                        <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="graduated" {{ old('status', $student->status) == 'graduated' ? 'selected' : '' }}>Graduated</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Parent Information Section --}}
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Parent/Guardian Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="parent_name" class="block text-sm font-medium text-gray-700">
                                        Parent/Guardian Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="parent_name" id="parent_name" 
                                           value="{{ old('parent_name', $student->parent_name) }}" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                <div>
                                    <label for="parent_phone" class="block text-sm font-medium text-gray-700">
                                        Parent/Guardian Phone <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="parent_phone" id="parent_phone" 
                                           value="{{ old('parent_phone', $student->parent_phone) }}" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="parent_email" class="block text-sm font-medium text-gray-700">
                                        Parent/Guardian Email
                                    </label>
                                    <input type="email" name="parent_email" id="parent_email" 
                                           value="{{ old('parent_email', $student->parent_email) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>
                            </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.students.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Cancel</a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Student
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>