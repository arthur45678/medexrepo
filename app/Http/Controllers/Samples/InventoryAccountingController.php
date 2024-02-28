<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Samples\InventoryAccounting;
use App\Models\Patient;
use App\Models\Approvement;
use Illuminate\Http\Request;

class InventoryAccountingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $inac_list = $patient->inventory_accountings()->onlyApproved()->with('chief_nurse')->get();

        return view("samples.inventory_accounting.index")->with(compact("inac_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.inventory_accounting.create")->with(compact('patient',));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Models\Patient $patient
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $request->validate([

            // 'bbe_number' => 'required|numeric',
            // 'biopsy_date' => 'required|date|before:tomorrow',

            // 'department_id' => 'required|numeric|exists:departments,id',
            // 'chamber' => 'nullable|numeric|exists:chambers,id',
            // 'sender_doctor_id' => 'required|numeric|exists:users,id',

            // // 'stationary_id' => 'required|numeric|numeric|exists:stationaries,id',
            // // 'glucose' => 'nullable|numeric',
            // // 'urine' => 'nullable|numeric',
            // // 'prothrombin' => 'nullable|numeric',
            // // 'amylase' => 'nullable|numeric',
            // // 'uroamylase' => 'nullable|numeric',

            'date' => 'required|date',
            'entry_date' => 'required|date',
            'bandage_nurse_id' => 'required|numeric|exists:users,id',
            'chief_nurse_id' => 'required|numeric|exists:users,id',
        ]);

        $patient->inventory_accountings()->create($request->all());
        return response()->json([
            'success' => __('samples.created'),
            'redirect' => route('samples.patients.inventory-accounting.create', $patient),
            'delay' => 2000
        ], 201);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $bl_id
     * @param  \App\Models\Samples\InventoryAccounting  $bl
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $inac_id)
    {

        $inac = $patient->inventory_accountings()->onlyApproved()->findOrFail($inac_id);
        return view("samples.inventory_accounting.show")->with(compact('patient', 'inac'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $em_id
     * @param  \App\Models\Samples\InventoryAccounting  $bl
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $inac_id)
    {

        $inac = $patient->inventory_accountings()->findOrFail($inac_id);
        $this->authorize("belongs-to-user", $inac);

        return view("samples.inventory_accounting.edit")->with(compact('patient', 'inac'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\InventoryAccounting  $bl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, $inac_id)
    {
        $inac = $patient->inventory_accountings()->findOrFail($inac_id);
        $this->authorize("belongs-to-user", $inac);

        $inac->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\InventoryAccounting  $biochemicalLabN1
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $inventory_accounting = InventoryAccounting::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_id',$id)->delete();

        if ($inventory_accounting==null){
            abort('404');
        }
        $inventory_accounting->delete();
        return back()->with('ok','colums delete');

    }
}
