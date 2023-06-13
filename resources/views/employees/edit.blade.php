<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Company
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-input-error class="mb-4" />
                    @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 alert-success" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 5.652a1 1 0 010 1.414L9.414 10l4.934 4.934a1 1 0 11-1.414 1.414L8 11.414l-4.934 4.934a1 1 0 01-1.414-1.414L6.586 10 1.652 5.066a1 1 0 111.414-1.414L8 8.586l4.934-4.934a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </span>
                    </div>
                    
                    @endif
                    <form action="{{route('employees.update', $employee)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


                        <div class="mb-4">
                            <x-input-label for="first_name" value="First Name" />
                            <x-text-input name="first_name" id="first_name" type="text" value="{{ $employee->first_name }}" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="last_name" value="Last Name" />
                            <x-text-input name="last_name" id="last_name" type="text" value="{{ $employee->last_name }}" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="company" :value="__('Company')" />
                            <select name="company_id" label="company" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                <option value="">Select a company</option>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ $company->id == $employee->company_id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-4">
                            <x-input-label for="email" value="Email" />
                            <x-text-input type="email" name="email" id="email" value="{{ $employee->email }}"  />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="phone" value="Phone" />
                            <x-text-input name="phone" id="phone" type="text" value="{{ $employee->phone }}"  />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>