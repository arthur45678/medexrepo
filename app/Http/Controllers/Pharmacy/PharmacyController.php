<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\MedicineList;
use App\Models\Pharmacy\PharmacyModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{

    public function __construct()
    {
        $pah = public_path('MedicineTransfer');
        if (!file_exists($pah) > 0 && !is_dir($pah)) {
            mkdir($pah, 0755, true);
        }
        // if (!file_exists($pah) > 0) {
        //     if (!is_dir($pah)) {
        //         mkdir($pah, 0755, true);
        //     }
        // }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        /department.json
        //        $path=public_path('department');
        //        $d = scandir($path, SCANDIR_SORT_NONE );
        //        $content = file_get_contents(public_path('department/'.$d[2]));
        //        $arrContent = json_decode($content, true);
        //        dd($arrContent);

        if (auth()->user()->can('search medicines')) :
            $pharmacy = PharmacyModel::DateAndMath()->get(); // բոլոր բաժինների համար
        else :
            $pharmacy = PharmacyModel::DateAndMath()->where('department_id', auth()
                ->user()->department_id)->get(); // կոնկրետ բաժնի համար
        endif;

        return view('pharmacy.index', compact('pharmacy'));
    }

    /**
     * Searching medication with different context (sum, cost, balance, enter).
     *
     * @return \Illuminate\Http\Response
     */
    public function findmedication(Request $request)
    {
        $pharmacys = PharmacyModel::DateAndMath()
            ->where('medicine_id', $request->prescription_medicine_id)->first();
        $pharmacys_balance_of_the_month = PharmacyModel::DateAndMath()
            ->where('medicine_id', $request->prescription_medicine_id)->get()->sum('balance_of_the_month');
        $pharmacys_enter = PharmacyModel::DateAndMath()
            ->where('medicine_id', $request->prescription_medicine_id)->get()->sum('enter');
        $pharmacys_cost = PharmacyModel::DateAndMath()
            ->where('medicine_id', $request->prescription_medicine_id)->get()->sum('cost');
        $pharmacys_balance_end_math_count = PharmacyModel::DateAndMath()
            ->where('medicine_id', $request->prescription_medicine_id)->get()->sum('balance_end_math_count');

        return view('pharmacy.index', compact(
            'pharmacys',
            'pharmacys_balance_of_the_month',
            'pharmacys_enter',
            'pharmacys_cost',
            'pharmacys_balance_end_math_count'
        ));
    }

    public function is_dir_empty($dir) {
        if (!is_readable($dir)) return NULL;
        return (count(scandir($dir, SCANDIR_SORT_NONE)) == 2);
    }

    /**
     * Store a newly inported xml from armsoft storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $path = public_path('MedicineTransfer');
        $dir = scandir($path, SCANDIR_SORT_NONE); // get dir, without sorting improve performace (see Comment below).
        if(count($dir) == 2) return back()->with(['warning' => 'XML-ֆալյերը բացակայում են']);

        $file_path = public_path('MedicineTransfer' . DIRECTORY_SEPARATOR . $dir[2]);
        $xmlFile = simplexml_load_file($file_path);
        $user_department = Department::where('id', auth()->user()->department_id)->first();

        foreach ($xmlFile as $MTMove) {

            if($MTMove->StorageIncome == $user_department->code)
            {
                foreach($MTMove->Specification->MTMoveSpecificationRow as $spec_row) {
                    // dump($spec_row);
                    $pharm = PharmacyModel::DateAndMath()->where('department_code', $MTMove->StorageIncome)
                    ->where('medicine_code', $spec_row->MTCode)->first();
                    // dump($pharm);

                    if ($pharm == null) {
                        $departament = Department::where('code', $MTMove->StorageIncome)->first();
                        $medicine = MedicineList::where('code', $spec_row->MTCode)->first();

                        $newpharm = PharmacyModel::create([
                            'department_id' => $departament->id,
                            'department_code' => $MTMove->StorageIncome,
                            'medicine_code' => $spec_row->MTCode,
                            'medicine_id' => $medicine->id,
                            'enter' => $spec_row->Quantity,
                            'price' => $spec_row->Amount,
                            'balance_of_the_month' => 0,
                        ]);
                    } else {
                        //update
                        $updatepharm = PharmacyModel::find($pharm->id)->update([
                            'enter' => $pharm->enter + $spec_row->Quantity,
                        ]);
                    }
                }

                if(file_exists($file_path)) unlink($file_path);
            }

            // $pharm = PharmacyModel::DateAndMath()->where('department_code', $MTMove->StorageIncome)
            //     ->where('medicine_code', $MTMove->Specification->MTMoveSpecificationRow->MTCode)->first();

            // if ($pharm == null) {
            //     $departament = Department::where('code', $MTMove->StorageIncome)->first();
            //     $medicine = MedicineList::where('code', $MTMove->Specification->MTMoveSpecificationRow->MTCode)->first();

            //     $newpharm = PharmacyModel::create([
            //         'department_id' => $departament->id,
            //         'department_code' => $MTMove->StorageIncome,
            //         'medicine_code' => $MTMove->Specification->MTMoveSpecificationRow->MTCode,
            //         'medicine_id' => $medicine->id,
            //         'enter' => $MTMove->Specification->MTMoveSpecificationRow->Quantity,
            //         'price' => $MTMove->Specification->MTMoveSpecificationRow->Amount,
            //         'balance_of_the_month' => 0,
            //     ]);
            // } else {
            //     //update
            //     $updatepharm = PharmacyModel::find($pharm->id)->update([
            //         'enter' => $pharm->enter + $MTMove->Specification->MTMoveSpecificationRow->Quantity,
            //     ]);
            // }
        }
        // dd('return back');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($data)
    {
        $pharmacy = PharmacyModel::DateAndMath()->where('act', $data)->get();;
        return view('pharmacy.index', compact('pharmacy', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function view($data)
    {
        if ($data == 'show-all') {

            $pharmacy = PharmacyModel::DateAndMath()->get();;
            return view('pharmacy.medication', compact('pharmacy'));

        } elseif ($data == 'medication') {

            $pharmacy = PharmacyModel::DateAndMath()->where('act', $data)->get();
            return view('pharmacy.medication', compact('pharmacy'));

        } elseif ($data == 'act') {

            $pharmacy = PharmacyModel::DateAndMath()->where('act', $data)->get();;
            return view('pharmacy.act', compact('pharmacy'));
        }
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
        $pharmacy = PharmacyModel::find($id);
        if (isset($request->act)) {
            $pharmacy->update(['act' => $request->act]);
        } else {
            $pharmacy->update(['act' => 'medication']);
        }
        return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function createdofmath()
    {
        $last_month_start = Carbon::now()->startOfMonth()->subMonth()->toDateString();
        $last_month_end = Carbon::now()->endOfMonth()->subMonth()->toDateString();
        $pharmacy = PharmacyModel::whereBetween('created_at', [$last_month_start, $last_month_end])->get();

        foreach ($pharmacy as $pharm) {
            if ($pharm->balance_end_math_count != 0) {
                $newpharm = PharmacyModel::create([
                    'department_id' => $pharm->department_id,
                    'department_code' => $pharm->department_code,
                    'medicine_code' => $pharm->medicine_code,
                    'medicine_id' => $pharm->medicine_id,
                    'enter' => 0,
                    'price' => $pharm->price,
                    'balance_of_the_month' => $pharm->balance_end_math_count,
                ]);
            }
        }
        return back();
    }


    public function updateofmath()
    {
        $pharmacy = PharmacyModel::DateAndMath()->get();
        foreach ($pharmacy as $pharm) {
            $plus = $pharm->balance_of_the_month + $pharm->enter - $pharm->cost;
            $pharm->update([
                'balance_end_math_count' => $plus
            ]);
        }
        return back();
    }
}
