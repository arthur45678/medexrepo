<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;

use App\Models\User;
use App\Models\Department;
use App\Models\DepartmentConnection;

use DB;
use Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $countAll = User::get()->count();
        // $data = User::orderBy('id', 'DESC')->paginate($countAll);
        // return view('admin.users.index', compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
        $data = User::with('department')->latest()->get();
        return view('admin.users.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        $departments = Department::all();
        return view('admin.users.create', compact('roles', 'departments'));
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
            'f_name' => 'required|string|min:3',
            'l_name' => 'required|string|min:3',
            'p_name' => 'required|string|min:3',
            'username' => 'required|string|min:3',
            'department_id' => 'required|integer|exists:departments,id',
            'password' => 'required|same:c_password',
            'roles' => 'required',
            'email' => 'required|email|unique:users,email',
            'position' => 'required|string|min:3',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('admin.users.index')
            ->with('success', 'Ավելացվեց');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->with([
            'roles', 'department','department_connections', 'department_connections.department'
            ])->first();
        return view('admin.users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $departments = Department::all();

        $department_connections_string = null;
        if ($user->department_connections->isNotEmpty()) {
            $department_connections_collection = $user->department_connections->pluck('department_id');
            $department_connections_array = $department_connections_collection->toArray();
            $department_connections_string = implode(',',  $department_connections_array);
        }

        $userRoleString = null;
        if(array_filter($userRole)) {
            $userRoleString =  implode(',',  $userRole);
        }

        return view('admin.users.edit', compact('user', 'roles', 'userRole', 'userRoleString', 'departments', 'department_connections_string'));
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
            'f_name' => 'required|string|min:3',
            'l_name' => 'required|string|min:3',
            'p_name' => 'required|string|min:3',
            'username' => 'required|string|min:3',
            'department_id' => 'required|integer|exists:departments,id',
            'roles' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'position' => 'required|string|min:3',

            'connect_department_ids' => 'nullable|string',
        ]);

        $input = $request->all();
        $connect_department_ids = $request->connect_department_ids;


        DepartmentConnection::where('user_id', '=', $id)->delete();
        if ($connect_department_ids) {
            $exploded_department_ids = explode(',', $connect_department_ids);
            foreach ($exploded_department_ids as $exploded_department_id) {
                DepartmentConnection::create([
                    'user_id' => $id,
                    'department_id' => $exploded_department_id
                ]);
            }
        }

        //$user = User::find($id);
        //$user->update($input);
        $user = User::updateUser($input, $id);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $roles = explode(',', $request->input('roles'));
        $user->assignRole($roles);

        return redirect()->route('admin.users.index')
            ->with('success', 'Թարմացվեց');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'Ջնջվեց');
    }
}
