<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DepartmentsStoreRequest;
use App\Http\Requests\Admin\DepartmentsUpdateRequest;
use App\Models\AdministrativeStaff;
use App\Models\Department;
use Spatie\Permission\Models\Permission;

class AdministrativeStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 0;
        $posts = AdministrativeStaff::with('departments')->get();
        return view('admin.administrative-staff.index',compact('posts', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Department::get();

        return view('admin.administrative-staff.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|unique:administrative_staff,title',
            /*'permission' => 'required',*/
        ]);

        $post = AdministrativeStaff::create(['title' => $request->input('title'), 'type' => 'type'.rand(1, 1000000000)]);
        $post->departments()->attach($request->permission);
        return redirect()->route('admin.administrative-staff.index')
            ->with('success','Ավելացվեց');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = AdministrativeStaff::find($id);
        //$post_rel = Department::find()
        $posts = AdministrativeStaff::with('departments')->where('id',$id)->get();

        return view('admin.administrative-staff.show',compact('posts','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = AdministrativeStaff::find($id);
        $permission = Department::get();
        $posts = AdministrativeStaff::with('departments')->where('id',$id)->get();
        $arr_checked = [];
        foreach($posts as $value){
            foreach($value->departments as $value){
                $arr_checked[] = $value->name;
            }
        }
        return view('admin.administrative-staff.edit', compact('permission','arr_checked','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $post = AdministrativeStaff::find($id);
        $post->title = $request->input('title');
        $post->departments()->detach();
        $post->departments()->attach($request->permission);
        $post->save();
        //$role->syncPermissions($request->input('permission'));
        return redirect()->route('admin.administrative-staff.index')
            ->with('success','Թարմացվեց');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = AdministrativeStaff::find($id);
        $post->departments()->detach();
        $post->delete();
        return redirect()->route('admin.administrative-staff.index')
            ->with('success', 'Ջնջվեց');
    }
}
