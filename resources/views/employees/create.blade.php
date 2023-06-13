<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Company
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-input-error class="mb-4" />

                    <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="first_name" value="First Name" />
                            <x-text-input name="first_name" id="first_name" required  value="{{old('first_name')}}"/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="last_name" value="Last Name" />
                            <x-text-input name="last_name" id="last_name" required value="{{old('last_name')}}"/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="company" :value="__('Company')" />
                            <select name="company_id" id="company_id">
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ $company->id == old('company_id') ? 'selected' : '' }}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" value="Email" />
                            <x-text-input type="email" name="email" id="email" value="{{old('email')}}"/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="phone" value="Phone" />
                            <x-text-input name="phone" id="phone" value="{{old('phone')}}"/>
                        </div>

                        <div class="flex items-center mt-4">
                            <x-primary-button>
                                Create
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>