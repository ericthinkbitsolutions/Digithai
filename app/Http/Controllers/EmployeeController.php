<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        if (Auth::user()->employee->type == 2) {
            $employees = Employee::where('user_id', Auth::user()->id)->paginate(10);
        } else {
            $employees = Employee::where('type', 2)->paginate(10);
        }
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|unique:employees',
        ]);


        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make('password');
        $user->save();
        $request->merge(['type' => 2, 'user_id' => $user->id]);
        Employee::create($request->all());
        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|unique:employees,email,' . $employee->id,
        ]);
        $employee->update($request->all());

        return redirect()->route('employees.edit', $employee)->with('success', 'Employee updated successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        $employee->user()->delete();

        return redirect()->route('employees.index')->with('danger', 'Employee deleted successfully.');
    }
}
