<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DepartmentsStoreRequest;
use App\Http\Requests\Admin\DepartmentsUpdateRequest;
use App\Models\AdministrativeStaff;
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

        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Display a structure of the resource's listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function structure()
    {
        $posts = AdministrativeStaff::with('departments')->get();
        return view('admin.departments.structure',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentsStoreRequest $request)
    {
        Department::storeDepartment($request->all());

        //  return response()->json(["success" => __("departments.created"), "redirect" => route('admin.departments.index')]);

        return redirect()->route('admin.departments.index')->with('success', __("departments.created"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        $this->authorize('view departments', $department);
        return view('admin.departments.show')->with(['department' => $department]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit')->with(['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentsUpdateRequest $request, $id)
    {
        $department = Department::find($id);
        $updated = Department::updateDepartment($request->all(), $id);
        if($updated && $department) {
            return redirect()->route('admin.departments.index')
            ->withSuccess("'$department->name' բաժինը հաջողությամբ թարմացվել է։");
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::find($id)->delete();
        return redirect()->route('admin.departments.index')
            ->with('success', 'Ջնջվեց');
    }
}
