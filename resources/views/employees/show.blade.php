<x-app-layout>
    <x-slot name="header">
        <h2>Employee Details</h2>
    </x-slot>

    <div class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center mb-4">Employee Details</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>First Name</th>
                            <td>{{ $employee->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>{{ $employee->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Company</th>
                            <td>{{ $employee->company->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                {{$employee->email}}
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $employee->phone }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>