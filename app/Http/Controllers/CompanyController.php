<?php

namespace App\Http\Controllers;

use App\Events\NewCompanyCreated;
use App\Mail\NewCompanyCreatedMail;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'logo' => ['image', 'dimensions:min_width=100,min_height=100'],
        ]);

        $company = new Company();
        $company->name = $request->name;
        $company->address = $request->address;
        $company->email = $request->email;
        $company->website = $request->website;

        if ($request->hasFile('logo')) {
            $logo = request()->file('logo');
            $logoPath = $logo->store('logos', 'public');
            $company->logo_name = $logoPath;
        }

        $company->save();

         // Dispatch the NewCompanyCreated event
         event(new NewCompanyCreated($company));

         // Send email to admin using Mailtrap
         Mail::to('admi@admin.com')->send(new NewCompanyCreatedMail($company));

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'logo' => ['image', 'dimensions:min_width=100,min_height=100'],
        ]);

        $company->name = $request->name;
        $company->address = $request->address;
        $company->email = $request->email;
        $company->website = $request->website;

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $logoPath = $request->file('logo')->store('logos', 'public');
            $company->logo_name = $logoPath;
        }

        $company->save();

        return redirect()->route('companies.edit', $company)->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        // Delete logo if exists
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return redirect()->route('companies.index')->with('danger', 'Company deleted successfully.');
    }
}
