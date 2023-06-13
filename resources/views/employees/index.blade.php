<x-app-layout>
    <x-slot name="header">
        <h2>Employees Management</h2>
    </x-slot>

    <div class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-md-10">
            @if (session('danger'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 danger" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('danger') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 5.652a1 1 0 010 1.414L9.414 10l4.934 4.934a1 1 0 11-1.414 1.414L8 11.414l-4.934 4.934a1 1 0 01-1.414-1.414L6.586 10 1.652 5.066a1 1 0 111.414-1.414L8 8.586l4.934-4.934a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </span>
                </div>
                @endif
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
                <h3 class="text-center mb-4">Company List</h3>
                <div class="mb-4">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary">Create Employee</a>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-secondary">View</a>
                                    @if(Auth::user()->employee->type == 1)
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>