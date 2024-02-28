<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Contracts\Models\HasAttachments;

use App\Http\requests\User\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     *  Return json list
     *
     * @return \Illuminate\Http\Response
     */
    public function users_json(Request $request, User $user)
    {
        return response()->json($user->search($request->q ?? ""));
    }

    public function users_full_json(Request $request, User $user)
    {
        $all = $user::select('id', 'department_id', 'username', 'f_name', 'l_name', 'p_name')->get();

        if($request->filled('groupByRole')) {
            $role = $request->groupByRole;
            $all = $all->filter( function($value, $key) use($role) {
                return $value->hasRole($role);
            });
        }

        if ($request->filled('filterBy') && $request->filled('needle')) {
            $needle = $request->needle;
            $filterBy = $request->filterBy;
            $filtered = $all->filter(function ($value, $key) use ($filterBy, $needle) {
                return $value[$filterBy] == $needle;
            });
            // return response()->json(array_values($filtered->toArray()));
            return response()->json($filtered->values());
        }
        // return $all;
        return response()->json($all, 200,[
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

    public function users_roles_json(Request $request)
    {
        $roles = Role::select('name as value', 'name as label')->get();
        return response()->json($roles, 200,[
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'hello users index';
        $users = User::get();
        return view('users.index')->with(compact("users"));
    }

    public function list()
    {
        // return 'hello users list';
        $users = User::get();
        return view('users.list')->with(compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'hello users create';
    }
  public function changePssword()
    {

        return view('users.changePassword');
    }
 public function updatePssword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!\Hash::check($request->current_password,$user->password)) {

            return response()->json('error', 'Current password does not match!');
        }

        $user->password = \Hash::make($request->password);
        $user->save();


        return response()->json([

            'success' => __('samples.created'),
            'redirect' => route('login'),
            'delay' => 2000
        ], 201);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function storeAttachmentsForUser(
        Request $request,
        HasAttachments $model,
        User $user,
        string $key = "attachments",
        bool $multiple = true
    ) {
        if (!$request->hasFile($key)) return false;
        $class_name = class_basename(get_class($model));
        $files = $request->file($key);
        $attachments = [];

        if (!$multiple) $files = [$files];

        foreach ($files as $n => $attachment) {
            $attachment_name = pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME) . "-" .  time() . "." . $attachment->getClientOriginalExtension();
            $directory = "/public/users/{$user->id}/{$class_name}";
            $attachment->storePubliclyAs($directory, $attachment_name);
            if ($request->has("attachment_comments")) {
                $attachment_comment = $request->attachment_comments[$n];
                array_push($attachments, $model->attachments()->create(compact("attachment_name", "attachment_comment", "directory")));
            } else {
                array_push($attachments, $model->attachments()->create(compact("attachment_name", "directory")));
            }
        }

        return $attachments;
    }

    public function store_file(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'attachment_comments' => 'required|array',
            'attachment_comments.*' => 'nullable|string',
            'attachments' => 'required|file|max:50000'
        ]);

        $user = User::findOrFail($request->user_id);
        $attachments_saved = $this->storeAttachmentsForUser($request, $user, $user, 'attachments', false);

        return response()->json([
            "success" => __("patients.store_file_success"), "attachments" => $attachments_saved
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // return 'hello users show';
        return view('users.show')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!auth()->user()->can('update users')) abort(403, __('authorization.user.can-not-change-user'));
        return view("users.edit")->with(["user" => $user]);
    }

    /**
     * Update the specified resource in storage. Method authorize() is configured.
     *
     * @param  App\Http\requests\User\UserUpdateRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        # without: 1) username 2) password 3) account_suspended

        $user->update([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'p_name' => $request->p_name,
            'department_id' => $request->department_id,

            'residence_region' => $request->residence_region,
            'town_village' => $request->town_village,
            'street_house' => $request->street_house,

            'degree' => $request->degree,
            'position' => $request->position,

            'birth_date' => $request->birth_date,
            'passport' => $request->passport,
            'soc_card' => $request->soc_card,
            'nationality' => $request->nationality,
            'is_male' => $request->is_male,

            'm_phone' => $request->m_phone,
            'c_phone' => $request->c_phone,
            'email' => $request->email,
        ]);
        // return back()->withSuccess(__('users.updated'));
        return response()->json(["success" => __("users.updated")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function dtIndex()
    {
        return view('users.dtssp.index');
    }
    public function dtIndexProcessing(Request $request)
    {

        # request params
        $draw = $request->draw ?? 1;
        $start = $request->start ?? 0;
        $rowperpage = $request->length ?? 10;

        $order_arr = $request->order;
        $columns_arr = $request->columns;
        $search_arr = $request->search;

        $columnIndex = $order_arr[0]['column'] ?? 1; // Column index
        $columnName = $columns_arr[$columnIndex]['data'] ?? 'id'; // Column name
        $columnSortOrder = $order_arr[0]['dir'] ?? 'asc'; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        ## response params

        # Get filtered and ordered, take part and set to "records"
        $filteredAndOrdered = User::orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('users.f_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.l_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.p_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('users.username', 'like', '%' . $searchValue . '%');
            })->select('users.*')->get();
        $records = $filteredAndOrdered->skip($start)->take($rowperpage);
        // dd($records);


        # total records
        $totalRecordswithFilter = $filteredAndOrdered->count();
        $totalRecords = User::select('count(*) as allcount')->count();

        $data_arr = array();
        foreach ($records as $r_key => $record) {
            $data_arr[] = [
                'id' => $record->id,
                'f_name' => $record->f_name,
                'l_name' => $record->l_name,
                'p_name' => $record->p_name,
                'username' => $record->username,
                'full_name' => $record->full_name,
                'DT_RowAttr' => ['data-url' => url("/users/{$record->id}")],
                'DT_RowId' => 'row_' . $record->id,
                'DT_RowClass' => 'dt-users-row',
                'DT_RowData' => ['rowData' => ['papa' => 'Hayrik', 'mama' => 'Mayrik']],
            ];
        }
        // on front-end
        // let row_1 = $('#row_1').data().rowData; // => {papa: "Hyarik", mama: "Mayrik"}

        $response = [
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecords,
            'iTotalDisplayRecords' => $totalRecordswithFilter,
            'staff' => $data_arr, // by default is "data", is the value of dataSrc property of "ajax"-object in front.
        ];

        return response()->json($response);
    }
}
