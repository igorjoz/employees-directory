<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = request()->query('filter');

        if (!empty($filter)) {
            $departments = Department::sortable()
                ->withCount('users')
                ->where('name', 'like', '%' . $filter . '%')
                ->paginate(25);
        } else {
            $departments = Department::withCount('users')
                ->sortable()
                ->paginate(25);
        }

        return view(
            'department.index',
            [
                'departments' => $departments,
                'filter' => $filter,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'name' => ['required', 'max:100'],
            'description' => ['required', 'max:1000000'],
        ]);

        $department = Department::create($validated);

        return redirect()->route('department.index')
            ->with('flashMessage', 'Dodano dział "' . $department->name . '"');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        $departmentUsers = $department->users;

        return view(
            'department.show',
            [
                'department' => $department,
                'departmentUsers' => $departmentUsers,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view(
            'department.edit',
            [
                'department' => $department,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validated = request()->validate([
            'name' => ['required', 'max:100'],
            'description' => ['required', 'max:1000000'],
        ]);

        $department->update($validated);

        return redirect()->route('department.show', $department->id)
            ->with('flashMessage', 'Zmodyfikowano dział o id "' . $department->id . '"');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $departmentName = $department->name;
        $department->delete();

        return redirect()->route('department.index')
            ->with('flashMessage', 'Usunięto dział "' . $departmentName . '"');
    }
}
