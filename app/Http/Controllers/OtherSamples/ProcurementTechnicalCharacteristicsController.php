<?php


namespace App\Http\Controllers\OtherSamples;

use App\Http\Controllers\Controller;
use App\Models\OtherSamples\ProcurementTechnicalCharacteristics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\OtherSamples\ProcurementTechnicalCharacteristicsRequest;

class ProcurementTechnicalCharacteristicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procurements = ProcurementTechnicalCharacteristics::get();


        return view("otherSamples.procurement_technical_characteristics.index", compact('procurements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("otherSamples.procurement_technical_characteristics.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcurementTechnicalCharacteristicsRequest $request)
    {
        $procurement = ProcurementTechnicalCharacteristics::create($request->all());
        //$procurement->approvement()->create([
        //    "status" => 0, //Pending
        //    "department_id" => auth()->user()->department_id
        //]);

        return response()->json([
            'success' => __('samples.created'),
            'redirect' => route('otherSamples.ptc.index'),
            'delay' => 2000
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\OtherSamples\ProcurementTechnicalCharacteristics $procurementTechnicalCharacteristics
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $procurement = ProcurementTechnicalCharacteristics::get();
        return view("otherSamples.procurement_technical_characteristics.show", compact('procurement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\OtherSamples\ProcurementTechnicalCharacteristics $procurementTechnicalCharacteristics
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $procurement = ProcurementTechnicalCharacteristics::where('user_id', auth()->id())->where('id', $id)->first();
        if ($procurement == null) {
            abort('404');
        }
        return view("otherSamples.procurement_technical_characteristics.edit", compact('procurement'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OtherSamples\ProcurementTechnicalCharacteristics $procurementTechnicalCharacteristics
     * @return \Illuminate\Http\Response
     */
    public function update(ProcurementTechnicalCharacteristicsRequest $request, $procurementTechnicalCharacteristics)
    {
        $procurement = ProcurementTechnicalCharacteristics::find($procurementTechnicalCharacteristics)->update($request->all());
        return response()->json([
            'success' => __('samples.created'),
            'redirect' => route('otherSamples.ptc.index'),
            'delay' => 2000
        ], 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\OtherSamples\ProcurementTechnicalCharacteristics $procurementTechnicalCharacteristics
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $procurement = ProcurementTechnicalCharacteristics::where('user_id', auth()->id())
            ->where('id', $id)->first();

        if ($procurement == null) {
            abort('404');
        }
        $procurement->delete();
        return back();
    }
}
