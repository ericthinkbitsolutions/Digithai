<x-app-layout>
    <x-slot name="header">
        <h2>Company Details</h2>
    </x-slot>

    <div class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center mb-4">Company Details</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $company->name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $company->address }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $company->email }}</td>
                        </tr>
                        <tr>
                            <th>Logo</th>
                            <td>
                                @if ($company->logo_name)
                                <img src="{{ asset('storage/' . $company->logo_name) }}" alt="Logo" width="50">
                                @else
                                No Logo
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td>{{ $company->website }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>