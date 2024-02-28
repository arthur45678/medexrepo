<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Approvement;
use App\Models\Department;
use App\Models\diagnostic\DiagnosticAppointmentModels;
use App\Models\MeasurementUnit;
use App\Models\Pharmacy\PharmacyModel;
use App\Models\Samples\AppointmentSheetMode;
use App\Models\Samples\No_Medication;
use App\Models\Patient;
use App\Models\Chamber;
use App\Models\Bed;
use App\Models\Samples\PrescriptionModels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($data)
    {
        $patients = Patient::find($data);
        $sheet=$patients->assignment_sheet()->onlyApproved()->get();
        return view('samples.prescription.index', compact('patients', 'sheet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {

        $repeatables = 25;
//
//        $chambers = Chamber::select('id', 'number', 'department_id')->get()->toArray();
//        $beds = Bed::select('id', 'number', 'is_occupied', 'chamber_id')->get()->toArray();
        $departments = Department::find(auth()->user()->department_id);
        $diagnostics = DiagnosticAppointmentModels::get();
        $measurement_units = MeasurementUnit::get();
        return view('samples.prescription.create', compact('patient', 'diagnostics', 'departments', 'repeatables', 'measurement_units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request['prescription_medicine_id'][0] != null
                and $request['prescription_medicine_dose'][0] != null
                and $request['prescription_medicine_measure'][0] != null
                and $request['prescription_text'][0] != null) {


                $v = $this->validate($request, [
                    'hospital_room_number' => 'required',
                    'department' => 'required',
                    'patient_id' => 'required',
                    'user_id' => 'required',
                    'appointment_date' => 'required',
                    'end_day' => 'required',
                    'prescription_length' => 'required',
                    'prescription_medicine_id' => 'required',
                    'prescription_medicine_dose' => 'required',
                    'prescription_medicine_measure' => 'required',
                    'prescription_text' => 'required',
                ]);

                $parent = AppointmentSheetMode::create($request->all());

                foreach ($request['appointment_date'] as $k => $nomedication) {
                    $noMedication = No_Medication::create([
                        'appointment_sheet_id' => $parent->id,
                        'diagnostic_appointment_models' => $k + 1,
                        'appointment_date' => $request['appointment_date'][$k],
                        'end_day' => $request['end_day'][$k],
                    ]);
                }
                foreach ($request['prescription_medicine_id'] as $m => $prescription_medicine_measure) {
                    if ($prescription_medicine_measure != null):
                        $prescraption = PrescriptionModels::create([
                            'user_id' => auth()->user()->id,
                            'patient_id' => $request->patient_id,
                            'appointment_sheet_id' => $parent->id,
                            'medicine_id' => $prescription_medicine_measure,
                            'medicine_dose' => $request['prescription_medicine_dose'][$m],
                            'measurement_unit_id' => $request['prescription_medicine_measure'][$m],
                            'prescription_comments' => $request['prescription_text'][$m],
                        ]);
                    endif;
                }
                return 'reload';
            } else {
                return 'add-false';
            }

        } catch
        (\Exception $e) {

            return 'add-false';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $departments = Department::get();
        $sheet = AppointmentSheetMode::with(['departments'])->find($id);
        $noMedication = No_Medication::where('appointment_sheet_id', $sheet->id)->get();
        $patient = Patient::find($sheet->patient_id);
        $prescraption = PrescriptionModels::where('appointment_sheet_id', $sheet->id)->get();
        $measurement_units = MeasurementUnit::get();

        return view('samples.prescription.show', compact('patient', 'sheet',
            'departments', 'noMedication', 'prescraption', 'measurement_units'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repeatables = 25;
        $departments = Department::get();
        $sheet = AppointmentSheetMode::where('user_id',auth()->id())->find($id);

        if ($sheet==null){
            abort('404');
        }
        $noMedication = No_Medication::where('appointment_sheet_id', $sheet->id)->get();
        $patient = Patient::find($sheet->patient_id);
        $prescraption = PrescriptionModels::where('appointment_sheet_id', $sheet->id)->get();
        $measurement_units = MeasurementUnit::get();

        if ($sheet->created_at->format('d-m-d') == \Illuminate\Support\Carbon::today()->format('d-m-d')) {
            return view('samples.prescription.edit', compact('patient', 'sheet',
                'departments', 'noMedication', 'prescraption', 'measurement_units', 'repeatables'));
        }


    }
    public function sieorsheetEdit($id)
    {
        $repeatables = 25;
        $departments = Department::get();
        $sheet = AppointmentSheetMode::find($id);
        $noMedication = No_Medication::where('appointment_sheet_id', $sheet->id)->get();
        $patient = Patient::find($sheet->patient_id);
        $prescraption = PrescriptionModels::where('appointment_sheet_id', $sheet->id)->get();
        $measurement_units = MeasurementUnit::get();
     return view('samples.prescription.SeniorNurse', compact('patient', 'sheet',
                'departments', 'noMedication', 'prescraption', 'measurement_units', 'repeatables'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'hospital_room_number' => 'required',
                'department' => 'required',
            ]);
            AppointmentSheetMode::find($id)->update([
                'hospital_room_number' => $request->hospital_room_number,
                'department' => $request->department
            ]);
            return 'sheet-true';
        } catch
        (\Exception $e) {


            return 'sheet-false';
        }


    }

    public function nomedicationUpdate(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'appointment_date' => 'required|date',
                'end_day' => 'required|date',
            ]);
            $noMedication = No_Medication::find($id)->update([
                'appointment_date' => $request['appointment_date'],
                'end_day' => $request['end_day'],
            ]);
            return 'calendar-true';
        } catch
        (\Exception $e) {


            return 'calendar-false';
        }


    }


    public function nomedicationDelete(Request $request, $id)
    {
        $noMedication = No_Medication::find($id)->update([
            'appointment_date' => null,
            'end_day' => null,
        ]);

        return 'medication-delete';

    }

    public function medicationdelete(Request $request, $id)
    {
        $med = PrescriptionModels::find($id)->delete();

        return true;

    }

    public function medicationAdd(Request $request, $id)
    {
        try {
            if ($request['prescription_medicine_id'][0] != null
                and $request['prescription_medicine_dose'][0] != null
                and $request['prescription_medicine_measure'][0] != null
                and $request['prescription_text'][0] != null) {
                $this->validate($request, [
                    'prescription_medicine_id' => 'required|array',
                    'prescription_medicine_dose' => 'required|array',
                    'prescription_medicine_measure' => 'required|array',
                    'prescription_text' => 'required|array',
                ]);
                foreach ($request['prescription_medicine_id'] as $m => $prescription_medicine_measure) {
                    if ($prescription_medicine_measure != null):
                        $prescraption = PrescriptionModels::create([
                            'user_id' => auth()->user()->id,
                            'patient_id' => $request->patient_id,
                            'appointment_sheet_id' => $id,
                            'medicine_id' => $prescription_medicine_measure,
                            'medicine_dose' => $request['prescription_medicine_dose'][$m],
                            'measurement_unit_id' => $request['prescription_medicine_measure'][$m],
                            'prescription_comments' => $request['prescription_text'][$m],
                        ]);
                    endif;
                }
                return 'reload';
            } else {
                return 'add-false';
            }
        } catch
        (\Exception $e) {
            return 'add-false';
        }
    }

    public function medicationUpdate(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'prescription_medicine_id' => 'required',
                'prescription_medicine_dose' => 'required',
                'prescription_medicine_measure' => 'required',
                'prescription_text' => 'required',
            ]);

            $med = PrescriptionModels::find($id);
            $sheet = AppointmentSheetMode::find($med->appointment_sheet_id);
            $pharm=PharmacyModel::DateAndMath()->where('department_id',$sheet->department)->
            where('medicine_id',$request->prescription_medicine_id);
            $pharmfirst=$pharm->first();
            $plus=$pharmfirst->balance_of_the_month+$pharmfirst->enter-$pharmfirst->cost;
           if ($plus==0){
               return 'prescription-updatefalse';
           }

            $drugs = Patient\PatientMedicineHistory::where('appointment_sheet_id', $med->appointment_sheet_id)
                ->where('prescription_id', $id)->sum('drugs');


            $k = $request->drugs - $drugs;

            if ($request->drugs!=null) {
                if ($pharmfirst != null) {
                    if ($drugs == 0) {
                        $pharm->update([
                            'cost' => $pharmfirst->cost + $request->drugs,
                        ]);
                        Patient\PatientMedicineHistory::create([
                            'user_id' => auth()->user()->id,
                            'prescription_id' => $id,
                            'medicine_id' => $request->prescription_medicine_id,
                            'appointment_sheet_id' => $med->appointment_sheet_id,
                            'drugs' => $request->drugs,
                            'const' => $drugs + $k,
                        ]);

                    } else {

                        $pharm->update([
                            'cost' => $pharmfirst->cost + $k,
                        ]);
                        Patient\PatientMedicineHistory::create([
                            'user_id' => auth()->user()->id,
                            'prescription_id' => $id,
                            'medicine_id' => $request->prescription_medicine_id,
                            'appointment_sheet_id' => $med->appointment_sheet_id,
                            'drugs' => $k,
                            'const' => $drugs + $k,
                        ]);
                    }
                }
            }

            $drugs2 = Patient\PatientMedicineHistory::where('appointment_sheet_id', $med->appointment_sheet_id)
                ->where('prescription_id', $id)->sum('drugs');
            $med->update([
                'user_id' => auth()->user()->id,
//                'medicine_id' => $request->prescription_medicine_id,
                'medicine_dose' => $request->prescription_medicine_dose,
                'measurement_unit_id' => $request->prescription_medicine_measure,
                'prescription_comments' => $request->prescription_text,
                'drugs' => $drugs2,
            ]);



            return 'prescription-updatetrue';
        } catch
        (\Exception $e) {


            return 'prescription-updatefalse';
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $approvement = Approvement::where('approvable_type','App\Models\Samples\AppointmentSheetMode')->where('approvable_id', $id)->delete();

        No_Medication::where('appointment_sheet_id', $id)->delete();
        PrescriptionModels::where('appointment_sheet_id', $id)->delete();
        AppointmentSheetMode::find($id)->delete();
        return back();

    }
}
