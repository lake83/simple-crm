<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesRequest;
use App\Models\{Companies, Employees};
use Illuminate\Contracts\{Foundation\Application, View\Factory, View\View};
use Illuminate\Http\RedirectResponse;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        if (request()->ajax()) {
            return \Datatables::of(Employees::with('company'))
                ->addColumn('company', function (Employees $employee) {
                    return $employee->company->name;
            })->make(true);
        }
        return view('employees.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeesRequest $request
     * @return RedirectResponse
     */
    public function store(EmployeesRequest $request): RedirectResponse
    {
        Employees::create($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeesRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(EmployeesRequest $request, int $id): RedirectResponse
    {
        $company = Employees::findOrFail($id);
        $company->update($request->all());
        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $company = Employees::findOrFail($id);
        $company->delete();
        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully');
    }

    /**
     * Show the form for creating a new company.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('employees.create', ['companies' => Companies::getAll()]);
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param int $id
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $employee = Employees::findOrFail($id);
        $companies = Companies::getAll();
        return view('employees.edit', compact('employee', 'companies'));
    }
}
