<?php


namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Samples\HeatSheet;
use App\Models\Samples\HeatSheetCharts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeatSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {

        //HeatSheet::
        $apse_list = HeatSheet::where('patient_id',$patient->id)->onlyApproved()->with("attending_doctor")->get();
        return view("samples.heat_sheet.index", compact('patient','apse_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view("samples.heat_sheet.create", compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'admission_date' => 'nullable|date|before:tomorrow',
          //  'p' => 'numeric',
            //'t_0' => 'numeric',
        ]);

        $heat_sheet = new HeatSheet();
        $sheet = $heat_sheet->storeHeathSheet($request, $patient->id);

        $chart = new HeatSheetCharts();
        $chart->storeChart($request, $sheet->id);
        return response()->json(['success' => __('samples.created')]);
    }


   /* public function editChart(Patient $patient, $chart_id)
    {
        $chart = HeatSheetCharts::findOrFail($chart_id);
        return view('samples.heat_sheet.editChart');
    }

    public function updateChart(Request $request, Patient $patient, $chart_id)
    {
        $chart = HeatSheetCharts::findorFail($chart_id);

        $chart->update($request->all());
       // return response()->json(['success' => __('samples.updated')]);
        return redirect()->back()->with(['success' => __('samples.updated')]);

    }*/

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, $id)
    {
        $post = $patient->heat_sheet()->findOrFail($id);
        $charts = $post->heat_sheet_charts()->orderBy('day','ASC')->get();
        return view("samples.heat_sheet.show",compact('post','charts'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $post_id)
    {
        $post = $patient->heat_sheet()->findOrFail($post_id);
        $charts = $post->heat_sheet_charts()->get();



        return view("samples.heat_sheet.edit")->with(compact('patient', 'post','charts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Patient $patient, $post_id)
    {
        $request->validate([
            'admission_date' => 'nullable|date|before:tomorrow',
            'patient_age' => 'nullable|date|before:tomorrow',
            'attending_doctor_id' => 'required|numeric|exists:users,id',
        ]);

        $post = $patient->heat_sheet()->findOrFail($post_id);

        $this->authorize("belongs-to-user", $post);

        $res = $post->update($request->all());


        return response()->json(['success' => __('samples.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Samples\Echocardiogram  $echocardiogram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, $post_id)
    {
        $post = HeatSheet::findOrFail($post_id);
        $post_chart = HeatSheetCharts::findOrFail($post_id);
            $post_chart->delete();


            if($post->user_id == Auth::user()->id){
                $post->delete();
                return redirect()->back()->with(['success' => __('samples.deleted')]);

            }
    }
}
