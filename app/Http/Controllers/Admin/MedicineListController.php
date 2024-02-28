<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicineList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MedicineListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $pah=public_path('MedicineList');
        if (!file_exists($pah) > 0):
            if (!is_dir($pah)) {
                mkdir($pah, 0755, true);
            }endif;
    }
    public function index()
    {
        // medicinelists
        $lists = MedicineList::all();
        return view('admin.medicinelists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medicinelists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request){
            $input = $request->except('_token');
            $item = new MedicineList();
            $item->create($input);
            return redirect()->route('admin.medicine-lists.index')->with('msg', 'ok');
        }

        $filename = public_path('MedicineList');
        $d = scandir($filename, SCANDIR_SORT_NONE );

        $xmlFile = simplexml_load_file(public_path('MedicineList/'.$d[2]));
        foreach ($xmlFile->Material as $medicineList) {
            $medicine = DB::table('medicine_lists')->where('code', $medicineList->Code)->first();
            if($medicine==null){
                DB::table('medicine_lists')->insert([
                'code' => $medicineList->Code,
                'name' => $medicineList->Name,
                'unit' => $medicineList->Unit,
                'warehouse' => $medicineList->Group,
            ]);
            }
        }
        unlink($filename.'/'.$d[2]);
      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lists = MedicineList::find($id);
        return view('admin.medicinelists.edit', compact('lists'));
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
//        $v = $this->validate($request, [
//            'code' => 'required',
//            'name' => 'required',
//            'unit' => 'required',
//            'warehouse' => 'required',
//        ]);


        if ($request->name != '') {
            if ($request->status == 'active') {
                $medecin = MedicineList::find($id);
                $medecin->name = $request->input('name');
                $medecin->code = $request->input('code');
                $medecin->unit = $request->input('unit');
                $medecin->warehouse = $request->input('warehouse');
                $medecin->status = $request->input('status');
                $medecin->save();
            }else{
                $medecin = MedicineList::find($id);
                $medecin->name = $request->input('name');
                $medecin->code = $request->input('code');
                $medecin->unit = $request->input('unit');
                $medecin->warehouse = $request->input('warehouse');
                $medecin->status = $request->input('status');
                $medecin->save();
            }
            return redirect()->route('admin.medicine-lists.index');

        } else {
            if ($request->status == 'active') {
                $medecin = MedicineList::find($id);
                $medecin->status = 'inactive';
                $medecin->save();
                return redirect()->route('admin.medicine-lists.index');
            } else {
                $medecin = MedicineList::find($id);
                $medecin->status = 'active';
                $medecin->save();
                return redirect()->route('admin.medicine-lists.index');
            }

        }
        return redirect()->route('admin.medicine-lists.index');

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
}
