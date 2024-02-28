<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bed;
use App\Models\Chamber;
use App\Models\Department;

class BedListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Bed::with('chamber','chamber.department')->get();
        return view('admin.bed-lists.index', compact('lists'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $departments = Department::where('has_bads',1)->with('chambers')->get();
        $chambers = Chamber::where('status', 'active')->with('department')->get();
        return view('admin.bed-lists.create', compact('chambers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // եթե սենյակ-id-ով ու համարով կա մահճակալ, ապա մերժել նոր կրկնվող մահճակալի ստեղծումը
        $bed_exists = Bed::where([
            ['chamber_id', '=', $request->chamber_id],
            ['number', '=', $request->number]
        ])->first();

        if($bed_exists) {
            return back()->with('warning', 'Տվյալ համարով մահճակալը ընտրված բաժնի պալատի համար արդեն գոյություն ունի։')->withInput();
        }

        Bed::create($request->all());
        return redirect()->route('admin.bed-lists.index')
        ->with('success', 'Մահճակալը հաջողությաբմ ստեղծվել է։');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function show(Bed $bed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function edit($bed_id)
    {
        $bed = Bed::with('chamber','chamber.department')->findOrFail($bed_id);
        $chambers = Chamber::get();
        return view('admin.bed-lists.edit', compact('bed','chambers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bed $bed_list)
    {
        # ապաակտիվացման կոդը
        if ($request->has('deactivate')) {
            $bed_list->update(['status' => 'inactive']);
            return back()->with('success', "Մահճակալ N-{$bed_list->number} հաջողությամբ ապաակտիվացվել է։");
        }

        $request->validate([
            'chamber_id' => 'required|numeric|exists:chambers,id',
            'number' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'is_occupied' => 'required|boolean'
        ]);

        # նույն հատկանիշներով մահճակալի գոյության ստուգման կոդը
        $bed_exists = Bed::where([
            ['chamber_id', '=', $request->chamber_id],
            ['number', '=', $request->number]
        ])->first();

        if($bed_exists && $bed_exists->id !== $bed_list->id) {
            return back()->with('warning', 'Տվյալ համարով մահճակալը ընտրված բաժնի պալատի համար արդեն գոյություն ունի։')->withInput();
        }

        # մահճակալի պարամետրերի փոփոխման բուն կոդը
        $bed_list->update([
            'number' => $request->number,
            'chamber_id' => $request->chamber_id,
            'status' => $request->status,
            'is_occupied' => $request->is_occupied
        ]);
        return back()->with('success', "Մահճակալ id- {$bed_list->id} հաջողությամբ փոփոխվել է։");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bed $bed)
    {
        //
    }
}
