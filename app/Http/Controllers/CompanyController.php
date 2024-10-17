<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index () {
        return inertia('Companies/Index', [
            'companies' => Company::whereNotNull('name')->orderBy('name')->paginate(12)
        ]);
    }

    public function show (Company $company)
    {
        if ($company->is_active || $company->belongs_to_user) {

            return inertia('Companies/Show', [
                'company' => $company,
                'hasJobs' => $company->jobs()->exists()
            ]);
        }

        return abort(403);
    }

    public function edit (Company $company)
    {
        return inertia('Companies/Edit', [
            'company' => $company
        ]);
    }

    public function update (Request $request, Company $company)
    {
        $validated = $request->validate([
            'logo'    => ['nullable'],
            'name'    => ['required', Rule::unique('companies')->ignore($company->id)],
            'slogan'  => ['required'],
            'email'   => ['required', Rule::unique('companies')->ignore($company->id)],
            'website' => ['required', Rule::unique('companies')->ignore($company->id)],
            'street'  => ['required'],
            'city'    => ['required'],
            'state'   => ['required'],
            'about'   => ['required'],
        ]);

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => ['image', 'max:2048'],
            ]);

            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $validated['logo'] = $request->file('logo')->store('logos', 'public');

        } elseif (is_string($request->logo)) {
            $request->validate([
                'logo' => ['string'],
            ]);

        } elseif (is_null($request->logo)) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
        }

        $company->update($validated);

        return redirect('/companies/' . $company->id)->with('message', [
            'type'    => 'success',
            'content' => 'Your company has been updated successfully.'
        ]);
    }

    public function jobs (Company $company)
    {
        return Inertia('Companies/Jobs', [
            'company' => $company,
            'jobs'    => $company->jobs()->withCount('applications')->paginate(6)
        ]);
    }

    public function applications (Company $company)
    {
        $statusCount = $company->applications()->select('status')->get();

        return Inertia('Companies/Applications', [
            'company'      => $company,
            'applications' => $company->applications()->latest()->filter(request('status'))->with('candidate', 'work')->paginate(10)->withQueryString(),
            'status'       => $statusCount->countBy('status')->merge(['total' => $statusCount->count(), 'active' => request('status')]),
        ]);
    }
}
