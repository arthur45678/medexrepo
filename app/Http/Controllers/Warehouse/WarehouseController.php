<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\MedicineList;
use App\Models\Pharmacy\PharmacyModel;
use App\Models\Warehouse\MaterialHisotry;
use App\Models\Warehouse\WarehouseModels;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $pah=public_path('Warehouse');
        if (!file_exists($pah) > 0):
            if (!is_dir($pah)) {
                mkdir($pah, 0755, true);
            }endif;
    }
    public function index()
    {


        if (auth()->user()->can('view warehouse-items')):


            $warehouse=WarehouseModels::get();
        else:

            $warehouse=WarehouseModels::where('department_id', auth()
                ->user()->department_id)->get();
        endif;
        return view('wareHouse.index',compact('warehouse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $filename=public_path('Warehouse');
        $d = scandir($filename, SCANDIR_SORT_NONE ); // get dir, without sorting improve performace (see Comment below).
        $xmlFilesvalue = simplexml_load_file(public_path('Warehouse/'.$d[2]));

        $thisfilelink=public_path('Warehouse/'.$d[2]);

        $chekmaterial=MaterialHisotry::where('DocumentNumber',$xmlFilesvalue->MTMove->DocumentNumber)->get();
        if (count($chekmaterial)>0){
            if (File::exists($thisfilelink)) {

                unlink($thisfilelink);
            }
            return back()->with('warning','Այդ ֆայլը արդեն ավելացվաշ է');
        }else{
            MaterialHisotry::create([
                'DocumentNumber'=>$xmlFilesvalue->MTMove->DocumentNumber,
                'Comment'=>$xmlFilesvalue->MTMove->Comment,
                'StorageExpense'=>$xmlFilesvalue->MTMove->StorageExpense,
                'Chief'=>$xmlFilesvalue->MTMove->Chief,
            ]);
        }


        $xmlFile=$xmlFilesvalue->MTMove->Specification->MTMoveSpecificationRow;
        foreach($xmlFile as $Warehouse){
$department=Department::where('code',$xmlFilesvalue->MTMove->StorageExpense)->first();

            $house=WarehouseModels::where('department_id',$department->id)
                ->where('code',$Warehouse->MTCode)->first();

            if ($house==null){

                WarehouseModels::create([
                    "code"=>$Warehouse->MTCode,
                    "quantity"=>$Warehouse->Quantity,
                    "price"=>$Warehouse->Amount,
                    "exit"=>$Warehouse->IncomeSyntAcc,
                    "department_id"=>$department->id

                ]);

            }else{
//update
                $ka=WarehouseModels::find($house->id);
                $ka->update([
                    "quantity"=>$ka->quantity+$Warehouse->Quantity,
                ]);


            }
        }

            if (File::exists($thisfilelink)) {

                unlink($thisfilelink);
            }
return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
