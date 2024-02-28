<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Api\Queue;
use App\Models\Api\Patient;

use Illuminate\Support\Facades\Validator;



class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queues = Queue::with(['patient', 'user', 'department'])->where('expired', 0)->orderBy('enqueue_date', 'asc')->get();

        if ($request->ajax()) {
            return response()->json(['data' => $queues]);
        }

        return view('departments/reception/index_queue', compact('queues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $api_patient = Patient::with('queue')->first();
        return view('departments/reception/create_queue', compact('api_patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * THIS CONTROLLER's "store"-method works with mobile.
     * http://medexrepo/catalogs/departments.json
     * http://medexrepo/lists/users_full.json?filterBy=department_id&needle=2
     * http://medexrepo/api/patient/enqueue
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|numeric|exists:users,id',
            'patient_id' => 'required|numeric|exists:api_patients,id',
            'department_id' => 'nullable|numeric|exists:departments,id',

            'comment' => 'nullable|string',
            'enqueue_date' => 'required|date|after:yesterday',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $api_patient = Patient::with('queue')->find($request->patient_id);

        if (!is_null($api_patient->queue) && !$api_patient->queue->expired) {
            // if(is_null($api_patient->queue)) {
            // $message = "Ձեր հերթագրման համարն է - №{$api_patient->id}:";
            // $message = "Ձեր հերթագրման համարն է - №{$api_patient->queue->number}";

            return response()->json(['data' => ['number' => $api_patient->queue->number]], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);

            // return response()->json(['message' => $message], 401, [
            //     'Content-Type' => 'application/json;charset=UTF-8',
            //     'Charset' => 'utf-8'
            // ], JSON_UNESCAPED_UNICODE);
        }

        $latests =  Queue::latest()->first();
        $last_number =  $latests->number ?? 0;

        $queue = $api_patient->queue()->create([
            'user_id' => $request->user_id,
            'department_id' => $request->department_id,

            'number' => $last_number + 1,
            'comment' => $request->comment,
            'enqueue_date' => $request->enqueue_date
        ]);

        return response()->json(['data' => $queue], 201, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Api\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function show(Queue $queue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Api\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function edit(Queue $queue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Api\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Queue $queue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $reception_queue_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($reception_queue_id)
    {
        // \App\Models\Api\Queue
        $queue = Queue::findOrFail($reception_queue_id);
        $queue->delete();
        return back()->withSuccess(__("queues.deleted"));
    }
}
