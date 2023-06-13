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

                    <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="address" value="Address" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"  />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="logo" value="Logo" />
                            <x-text-input id="logo" class="block mt-1 w-full" type="file" name="logo" :value="old('logo')"  />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="website" value="Website" />
                            <x-text-input id="website" class="block mt-1 w-full" type="text" name="website" :value="old('website')"  />
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
