{{-- resources/views/admin/teachers/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Teacher') }}
            </h2>
            <a href="{{ route('admin.teachers.index') }}" 
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

                    <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Personal Information Section --}}
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Personal Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Name --}}
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           value="{{ old('name') }}"
                                           required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           id="email" 
                                           value="{{ old('email') }}"
                                           required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                {{-- Password --}}
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        Password <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" 
                                           name="password" 
                                           id="password" 
                                           required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                                </div>

                                {{-- Phone --}}
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">
                                        Phone Number
                                    </label>
                                    <input type="text" 
                                           name="phone" 
                                           id="phone" 
                                           value="{{ old('phone') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                {{-- Date of Birth --}}
                                <div>
                                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">
                                        Date of Birth <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" 
                                           name="date_of_birth" 
                                           id="date_of_birth" 
                                           value="{{ old('date_of_birth') }}"
                                           required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                {{-- Address --}}
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700">
                                        Address
                                    </label>
                                    <textarea name="address" 
                                              id="address" 
                                              rows="3"
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Employment Information Section --}}
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Employment Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Employee ID --}}
                                <div>
                                    <label for="employee_id" class="block text-sm font-medium text-gray-700">
                                        Employee ID <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           name="employee_id" 
                                           id="employee_id" 
                                           value="{{ old('employee_id') }}"
                                           required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                {{-- Qualification --}}
                                <div>
                                    <label for="qualification" class="block text-sm font-medium text-gray-700">
                                        Qualification <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           name="qualification" 
                                           id="qualification" 
                                           value="{{ old('qualification') }}"
                                           placeholder="e.g., M.Ed, B.Ed, Ph.D"
                                           required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                {{-- Joining Date --}}
                                <div>
                                    <label for="joining_date" class="block text-sm font-medium text-gray-700">
                                        Joining Date <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" 
                                           name="joining_date" 
                                           id="joining_date" 
                                           value="{{ old('joining_date') }}"
                                           required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                {{-- Specialization --}}
                                <div>
                                    <label for="specialization" class="block text-sm font-medium text-gray-700">
                                        Specialization
                                    </label>
                                    <input type="text" 
                                           name="specialization" 
                                           id="specialization" 
                                           value="{{ old('specialization') }}"
                                           placeholder="e.g., Mathematics, Science"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                {{-- Salary --}}
                                <div>
                                    <label for="salary" class="block text-sm font-medium text-gray-700">
                                        Salary (Optional)
                                    </label>
                                    <input type="number" 
                                           name="salary" 
                                           id="salary" 
                                           value="{{ old('salary') }}"
                                           step="0.01"
                                           placeholder="0.00"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>
                            </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.teachers.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Teacher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>