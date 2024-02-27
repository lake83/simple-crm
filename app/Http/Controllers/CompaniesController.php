<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompaniesRequest;
use Illuminate\Contracts\{Foundation\Application, View\Factory, View\View};
use Illuminate\Http\RedirectResponse;
use App\Models\Companies;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        if (request()->ajax()) {
            return \Datatables::of(Companies::query())->make(true);
        }
        return view('companies.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompaniesRequest $request
     * @return RedirectResponse
     */
    public function store(CompaniesRequest $request): RedirectResponse
    {
        $company = Companies::create($request->all());

        if ($logo = $request->file('logo')) {
            $logo->storeAs('companies', ($fileName = $company->id . '_logo.' . $logo->clientExtension()), 'public');
            $company->update(['logo' => $fileName]);
        }
        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompaniesRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CompaniesRequest $request, int $id): RedirectResponse
    {
        $company = Companies::findOrFail($id);

        if ($logo = $request->file('logo')) {
            $logo->storeAs('companies', ($fileName = $id . '_logo.' . $logo->clientExtension()), 'public');
            $company->update(['logo' => $fileName]);
        }
        $company->update($request->only('name', 'email', 'website'));
        return redirect()->route('companies.index')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $company = Companies::findOrFail($id);
        $company->delete();
        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully');
    }

    /**
     * Show the form for creating a new company.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('companies.create');
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param int $id
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $company = Companies::findOrFail($id);
        return view('companies.edit', compact('company'));
    }
}
