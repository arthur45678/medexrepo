<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Model\Samples\BloodTransfusionRecordBook;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Approvement;

class BloodTransfusionRecordBookController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $btrb_list = $patient->blood_transfusion_record_books()->onlyApproved()->get();

        return view("samples.blood_transfusion_record_book.index")->with(compact("btrb_list", "patient"));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient, $btrb_id)
    {
        $lates_stationary = $patient->stationaries()->latest()->first();
        $btrb = $patient->blood_transfusion_record_books()->findOrFail($btrb_id);
        return view('samples.blood_transfusion_record_book.create')->with(compact('patient', 'btrb','lates_stationary'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\Samples\BloodTransfusionRecordBook
     * @param  \App\Models\Patient $patient
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $patient->blood_transfusion_record_books()->create($request->all());
        return response()->json(['success' => __('samples.created')]);
    }

    /**
     * Display the specified resource.
     *    * Display the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $btrb_id
     * @param  \App\Model\Samples\BloodTransfusionRecordBook  $btrb
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $btrb_id)
    {
        $lates_stationary = $patient->stationaries()->latest()->first();
        $btrb = $patient->blood_transfusion_record_books()->findOrFail($btrb_id);
        // dd($btrb);
        return view("samples.blood_transfusion_record_book.show")->with(compact('patient', 'btrb', 'lates_stationary' ));

    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Patient $patient
     * @param  int  $btrb_id
     * @param  \App\Model\Samples\BloodTransfusionRecordBook  $btrb
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $btrb_id)
    {
        $btrb = $patient->blood_transfusion_record_books()->findOrFail($btrb_id);
        $this->authorize("belongs-to-user", $btrb);

        return view("samples.blood_transfusion_record_book.edit")->with(compact('patient', 'btrb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Samples\BloodTransfusionRecordBook  $btrb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BloodTransfusionRecordBook $btrb)
    {
        $btrb= $patient->blood_transfusion_record_books()->findOrFail($btrb_id);
        $this->authorize("belongs-to-user", $btrb);

        $btrb->update($request->all());

        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Samples\BloodTransfusionRecordBook $blood_transfusion_record_book
     * @return \Illuminate\Http\Response
     */
    public function destroy($patent_id,$id)
    {
        $btrb = BloodTransfusionRecordBook::where('patient_id',$patent_id)->where('user_id',auth()->id())->find($id);
        $approvement=Approvement::where('approvable_id',$id)->delete();

        if ($btrb==null){
            abort('404');
        }
        $btrb->delete();
        return back()->with('ok','colums delete');
    }
}
