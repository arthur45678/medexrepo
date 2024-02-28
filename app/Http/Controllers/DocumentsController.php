<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Stationary;
use App\Models\Ambulator;

use App\Models\PatientFirstInfo;
use App\Models\Samples\AnesthesiologDiagnosis;

use App\Models\StationarySocialPackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use PDF;

class DocumentsController extends Controller
{

    public function get_stationary_pdf($patient_id, $stationary_id)
    {
        $patient = Patient::find($patient_id);
        $stationary = Stationary::where([['id', '=', $stationary_id], ['patient_id', '=', $patient_id]])->first();
        $for_pdf = true;
        $stationary_social_packages = StationarySocialPackage::where('id','=', $patient->id)->with('package_item')->get();
        $date = date('Y-m-d_H-i-s', strtotime($stationary->admission_date));

        // return view('stationary.show_page1', compact('patient', 'stationary'));

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView('stationary.show_page1', compact('patient', 'stationary', 'for_pdf', 'stationary_social_packages'));
        return $pdf->stream();
        // return $pdf->download('stationary_down_'.$date.'.pdf');
    }

    public function get_ambulator_pdf($patient_id, $ambulator_id)
    {
        $patient = Patient::find($patient_id);
        $ambulator = Ambulator::where([['id', '=', $ambulator_id], ['patient_id', '=', $patient_id]])->first();
        $first_info = PatientFirstInfo::where('patient_id', '=', $patient->id)->with('first_clinic_item', 'first_discovered_item')->get();
        $histological = DB::table('stationary_histological_examinations')->where('stationary_id', '=', $patient->id)->get();
        $cellular = DB::table('stationary_cellular_examinations')->where('stationary_id', '=', $patient->id)->get();
        $stationaries = DB::table('stationaries')
            ->join('stationary_surgeries', 'stationaries.id', '=', 'stationary_surgeries.stationary_id')
            ->select(
                'stationaries.id as stationary_id',
                'stationaries.admission_date',
                'stationaries.discharge_date',
                'stationaries.number',
                'stationary_surgeries.id as surgery_id',
                'stationary_surgeries.surgery_date'
            )->where('stationaries.patient_id', '=', $patient->id)->get();

        $patient = $patient->with([
            'first_info',
            'harmfuls',
            'cancer_groups',
            'ambulator'
        ])->first();
        $for_pdf = true;

        $date = date('Y-m-d', strtotime($ambulator->registration_date)) . '_' . date("h-i-s");

        // return view('ambulators.show_page1', compact('patient', 'ambulator'));

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $pdf = PDF::loadView('ambulators.show_page1', compact('patient', 'ambulator', 'for_pdf', 'stationaries', 'histological', 'first_info', 'cellular'));
        return $pdf->stream();
        // return $pdf->download('ambulator_down_'.$date.'.pdf');
    }

    /**
     * Էնդոսկոպիկ և ուլտրաձայնային հետազոտություն - pdf
     * @param $patient_id
     * @param $uex_id
     * @return stream
     */
    public function get_uex_pdf($patient_id, $uex_id)
    {
        $patient = Patient::find($patient_id);
        $uex = $patient->ultrasound_endoscopic_examinations()->onlyApproved()->findOrFail($uex_id);
        // return view("samples.ultrasound_endoscopic_examination.show")->with(compact('patient', 'uex'));

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView('samples.ultrasound_endoscopic_examination.show', compact('patient', 'uex', 'for_pdf'));
        return $pdf->stream();
    }

    /**
     * ԷՐԻՏՐՈՑԻՏՆԵՐԻ ՄՈՐՖՈԼՈԳԻԱ - pdf
     * @param $patient_id
     * @param $uex_id
     * @return stream
     */
    public function get_erythrocyte_morphology_pdf($patient_id, $erythrocyte_morphology_id)
    {
        $patient = Patient::find($patient_id);
        $em = $patient->erythrocyte_morphologies()->onlyApproved()->with("attending_doctor")->find($erythrocyte_morphology_id);

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView('samples.erythrocyte_morphology.show', compact('patient', 'em', 'for_pdf'));
        return $pdf->stream();
    }

    public function get_ape_pdf($patient_id, $ape_id)
    {
        $patient = Patient::find($patient_id);
        $lates_stationary = $patient->stationaries()->latest()->first();

        $apse = $patient->anesthesiology_presurgery_examinations()->find($ape_id);
        $anestologia_a = AnesthesiologDiagnosis::where('type', 'a')->where('anesthesiolog_id', $ape_id)->get();
        $anestologia_b = AnesthesiologDiagnosis::where('type', 'b')->where('anesthesiolog_id', $ape_id)->get();
        $anestologia_c = AnesthesiologDiagnosis::where('type', 'c')->where('anesthesiolog_id', $ape_id)->get();
        $anestologia_d = AnesthesiologDiagnosis::where('type', 'd')->where('anesthesiolog_id', $ape_id)->get();
        $anestologia_e = AnesthesiologDiagnosis::where('type', 'e')->where('anesthesiolog_id', $ape_id)->get();

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView(
            'samples.anesthesiology.show',
            compact(
                'for_pdf',
                'patient',
                'apse',
                'lates_stationary',
                'anestologia_a',
                'anestologia_b',
                'anestologia_c',
                'anestologia_d',
                'anestologia_e'
            )
        );
        return $pdf->stream();
    }

    public function get_radiation_treatment_card_pdf($patient_id, $rtc_id)
    {
        $patient = Patient::find($patient_id);
        $card = $patient->radiation_treatment_card()->findOrFail($rtc_id);

        PDF::setOptions(['dpi' => 100, 'defaultFont' => 'DejaVuSans']);
        $for_pdf = true;
        $pdf = PDF::loadView('samples.radiation_treatment_cards.show', compact('patient', 'card', 'for_pdf'));
        return $pdf->stream();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function received()
    {
        $documents = [
            [
                'id' => 1,
                'data' => '02.06.2020',
                'document_name' => 'Ուղեգիր',
                'attach_document' => true,
                'sending_department' => 'Թերապիայի բաժանմունք',
                'sender' => 'Թերապևտ',
                'social_number' => '5601020304'

            ],

            [
                'id' => 1,
                'data' => '02.06.2020',
                'document_name' => 'Ուղեգիր',
                'attach_document' => true,
                'sending_department' => 'Թերապիայի բաժանմունք',
                'sender' => 'Թերապևտ',
                'social_number' => '5601020304'
            ]
        ];

        return view('documents.received', ['documents' => $documents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.generate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $card_number = $request->card_number;
        $cancer_type = $request->cancer_type;
        // $bad_habits = $request->bad_habits;
        $patient_gender = $request->patient_gender;
        $text = $request->text;
        $data_from_medex = [
            "patient_first_name" => "Սիմոն",
            "patient_last_name" => "Սիմոնյան",
            "patient_father_name" => "Սիմոնի",
            "patient_birth_date" => "14/06/1980",
            "patient_settlement" => "Երևան",
            "patient_city" => "Երևան"
        ];

        $variant = $request->get("file_type", "word");

        $headers = [
            "Content-Disposition" => "attachment;Filename=Card.doc",
            "Content-type" => "text/html"
        ];

        $data = array_merge($data_from_medex, compact("card_number", "cancer_type", "text", "patient_gender", "text"));

        $content = view("ambulators.show_page1")
            ->with($data)
            ->render();

        if ($variant === "word") {
            return response($content, 200, $headers);
        } else {
            $pdf = PDF::loadView('ambulators.show_page1', $data);
            return $pdf->download('Card.pdf');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view("patients.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
