<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Chamber;
use App\Models\Department;
use Illuminate\Http\Request;

class ChamberListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Chamber::with('department', 'beds')->get();
        return  view('admin.chamber-lists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('has_bads', 1)->get(); //
        return  view('admin.chamber-lists.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // եթե բաժնի-id-ով ու համարով կա սենյակ, ապա մերժել նոր կրկնվող սենյակի ստեղծումը
        $chamber_exists = Chamber::where([
            ['department_id', '=', $request->department_id],
            ['number', '=', $request->number]
        ])->first();

        if($chamber_exists) {
            return back()->with('warning', 'Տվյալ համարով պալատը ընտրված բաժնի համար արդեն գոյություն ունի։')->withInput();
        }

        Chamber::create($request->all());
        return redirect()->route('admin.chamber-lists.index')
        ->with('success', 'Պալատը հաջողությաբմ ստեղծվել է։');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chamber  $chamber
     * @return \Illuminate\Http\Response
     */
    public function show(Chamber $chamber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chamber  $chamber
     * @return \Illuminate\Http\Response
     */
    public function edit($chamber_id)
    {
        $chamber = Chamber::with('department', 'beds')->findOrFail($chamber_id);
        $departments = Department::get();
        return  view('admin.chamber-lists.edit', compact('chamber', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chamber  $chamber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chamber $chamber_list)
    {
        # ապաակտիվացման կոդը
        if ($request->has('deactivate')) {
            if($request->status=='active'){
                $chamber_list->update(['status' => 'inactive']);
                return back()->with('success', "Պալատ N-{$chamber_list->number} հաջողությամբ ապաակտիվացվել է։");
            }else{
                $chamber_list->update(['status' => 'active']);
                return redirect()->route('admin.chamber-lists.index')
                    ->with('success', "Պալատ N-{$chamber_list->number} հաջողությամբ ապաակտիվացվել է։");
            }

        }

        $request->validate([
            'department_id' => 'required|numeric|exists:departments,id',
            'number' => 'required|numeric',
            'status' => 'required|in:active,inactive'
        ]);

        # նույն հատկանիշներով պալատի գոյության ստուգման կոդը
        $chamber_exists = Chamber::where([
            ['department_id', '=', $request->department_id],
            ['number', '=', $request->number]
        ])->first();

        if($chamber_exists && $chamber_exists->id !== $chamber_list->id) {
            return back()->with('warning', 'Տվյալ համարով պալատը ընտրված բաժնի համար արդեն գոյություն ունի։')->withInput();
        }

        # պալատի պարամետրերի փոփոխման բուն կոդը
        $chamber_list->update([
            'number' => $request->number,
            'department_id' => $request->department_id,
            'status' => $request->status
        ]);
        return back()->with('success', "Պալատ id- {$chamber_list->id} հաջողությամբ փոփոխվել է։");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chamber  $chamber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chamber $chamber)
    {
        //
    }
}
