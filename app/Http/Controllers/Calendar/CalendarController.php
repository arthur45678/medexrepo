<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Calendar\CalendarModel;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d').'%';
        $auth_man=1;
        $list=CalendarModel::with('patient')->where('start', 'like', $today)->where('user_id',auth()->id())
            ->where('status','active')->orderBy('id','desc')->get();
        $all = CalendarModel::all();
        return view('calendar.index',compact('list','auth_man','all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        soc_card

        if ($request->user_id==auth()->id()):

                $date = $request->date;
                $res = explode("/", $date);
                $changedDate = $res[2]."-".$res[0]."-".$res[1];



        $patients=Patient::where('soc_card',$request->soc)->first();

        if ($request->id == null):
       CalendarModel::create([
           'name'=>$request->name,
           'patient_id'=>$patients->id??null,
           'soc'=>$request->soc,
           'comments'=>$request->description,
           'start'=>$changedDate.' '.$request->start,
           'end'=>$request->end,
           'user_id'=>$request->user_id,
           'status'=>'active'
           ]);
        else:
            $cal=CalendarModel::find($request->id)->update([
                'name'=>$request->name,
                'patient_id'=>$patients->id??null,
                'soc'=>$request->soc,
                'comments'=>$request->description,
                'start'=>$changedDate.' '.$request->start,
                'end'=>$request->end,
                'user_id'=>$request->user_id,
                'status'=>'active'
            ]);


            endif;
endif;

       return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {

        $auth_man=0;
        if ($user_id==auth()->id()){
            $auth_man=1;
        }

        $today = Carbon::now()->format('Y-m-d').'%';

        $list=CalendarModel::with('patient')->where('start', 'like', $today)->where('user_id',$user_id)
            ->where('status','active')->orderBy('id','desc')->get();

        $all = CalendarModel::with('patient')->where('user_id',$user_id)
            ->where('status','active')->orderBy('id','desc')->get();

        return view('calendar.index',compact('all','list','user_id','auth_man'));
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
    public function find(Request $request)
    {

        $date = $request[0]['calendar'];
        $res = explode("/", $date);
        $changedDate = $res[2]."-".$res[0]."-".$res[1];

        $today = $changedDate.'%';

        $list=CalendarModel::with('patient')->where('start', 'like', $today)->where('user_id',$request[0]['user_id'])
            ->where('status','active')->orderBy('id','desc')->get();
        return  $list;
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
