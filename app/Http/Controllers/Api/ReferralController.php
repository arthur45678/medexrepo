<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Referral;
use App\Models\Patient;

use App\Events\ReferralReceivedEvent;
use App\Events\DepartmentReferralReceivedEvent;
use App\Models\PatientConnection;
use App\Models\ServiceList;
use App\Models\Queue;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receivedReferrals = auth()->user()->received_referrals()->with("sender", "services")->get();
        // dump($receivedReferrals);
        return view("referrals.received", compact("receivedReferrals"));
    }

    /**
     * Display a listing of the received resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receivedIndex(Request $request)
    {

        $user = User::findOrFail($request->user_id);

        if (is_null($user )) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        if ($request->ajax()) {
            $receivedReferrals = $user->received_referrals()->with(["sender", "sender.department"])->orderBy("opened_at")->limit(20)->get();
            $unopenedReferralsCount = $receivedReferrals->where("opened_at", null)->count();

            return response()->json(['data' => compact("receivedReferrals", "unopenedReferralsCount")], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);

         //   return response()->json(compact("receivedReferrals", "unopenedReferralsCount"));
        }

        $receivedReferrals = $user->received_referrals()->with(["sender", "sender.department", "services", "patient" => function ($q) {
            $q->setEagerLoads([]);
        }])->latest()->get();

        return response()->json(['data' => $receivedReferrals], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);


    }

    // received but not assigned
    public function receivedNotAssigned(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if (is_null($user )) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }


       // $this->authorize('is-department-head-or-registrar');
        if ($user->can('is-department-head-or-registrar')) {
            $receivedReferrals = Referral::where([
                ['department_id', '=', auth()->user()->department_id],
                ['receiver_id', '=', null]
            ])->with(["sender", "sender.department", "services", "patient"])->latest()->get();
            // dump($receivedReferrals);
            $assigned_to = "not_assigned";

            return response()->json(['data' => ['receivedReferrals' => $receivedReferrals, 'assigned_to' => $assigned_to]], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['message' => 'Դուք չունեք համապատասխան իրավասություն։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }





    }

    // received and assigned to anyone
    public function receivedAssigned(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if (is_null($user )) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        //$this->authorize('is-department-head-or-registrar');
        if ($user->can('is-department-head-or-registrar')) {
            $receivedReferrals = Referral::where([
                ['department_id', '=', $user->department_id],
                ['receiver_id', '<>', null],
                ['receiver_id', '<>', auth()->id()],
            ])->with(["sender", "sender.department", "services", "patient", "receiver"])->latest()->get();
            // dump($receivedReferrals);
            $assigned_to = "assigned";


            return response()->json(['data' => ['receivedReferrals' => $receivedReferrals, 'assigned_to' => $assigned_to]], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['message' => 'Դուք չունեք համապատասխան իրավասություն։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }




    }

    public function servicesIndex(Request  $request)
    {
        $user = User::findOrFail($request->user_id);

        $referrals = $user->received_referrals()->where("finished_at", "!=", null)->with(["services", "sender", "sender.department", "patient" => function ($q) {
            $q->setEagerLoads([]);
        }])->get();


        $services = [];
        $referrals->map(function ($referral) use (&$services) {
            $referral->services->map(function ($service) use ($referral, &$services) {
                $service->patient = $referral->patient;
                $service->sender = $referral->sender;
                $services[] = $service;
            });
        });

        return response()->json(['data' => $services], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }

    /**
     * Display a listing of the sent resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sentIndex(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        if (is_null($user )) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $sentReferrals = $user->sent_referrals()
            ->with([
                "receiver", "department", "services", "patient" => function ($q) {
                    $q->setEagerLoads([]);
                }
            ])->latest()->get();

        if ($request->ajax()){
            return response()->json(['data' => $sentReferrals], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['data' => $sentReferrals], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }

    /**
     * Display a listing of the sent resource by other users.
     *
     * @return \Illuminate\Http\Response
     */
    public function sentOthers(Request $request)
    {

        $user = User::find($request->user_id);

        if (is_null($user )) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
        if( $user->hasAnyRole('department_head') ){
            $department_workers_ids = User::where('department_id', $user->department_id)->pluck('id');
            $sentReferrals = Referral::whereIn('sender_id', $department_workers_ids)
                ->with(["receiver", "department", "services", "patient", "sender"])->latest()->get();

            return response()->json(['data' => $sentReferrals], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['errors' => $validator->errors()], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $repeatables = 5;
        $data_limit = 10;
        return view("referrals.create")->with(compact("patient", "repeatables", "data_limit"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {

        /**
         * չլրացված բաժնով ուղեգրը չի գնում
         * ընտրված ծառայութնունների ընդհանուր քանակը պետք է լինի առնվազն ոչ պակաս, քան ուղեգրերի քանակը
         */

        $department_ids = array_filter(array_slice($request->department_id, 0, $request->referral_wrap_length));
        if (count($department_ids)) {

            $selected_services_count = array_reduce($request->service_id, function ($carry, $item) {
                $carry = count(array_filter($item)) ? ($carry + 1) : $carry;
                return $carry;
            }, 0);

            if ($selected_services_count < $request->referral_wrap_length) {
                return back()->withWarning('Ստուգեք՝ արդյո՞ք "Ծառայություն" դաշտը ընտրված է բոլոր ուղեգրերի համար');
            }

            $patient_id = $patient->id;

            foreach ($department_ids as $d_key => $department_id) {
                $receiver_id = $request->receiver_id[$d_key];
                $sender_id = auth()->id();
                $referral_data = compact("department_id", "receiver_id", "sender_id", "patient_id");

                $referral = Referral::create($referral_data); // save Referral

                # ամեն ուղեգրին իրա քոննեքշընը - նախորոք, թեկուզ receiver_id-ն null-ով։
                # եթե receiver_id-ն null-է, այն թարմացնում ենք հերթագրման ժամանակ
                $patient_connection = $referral->patient_connection()->create([
                    "sender_id" => $referral->sender_id,
                    "receiver_id" => $referral->receiver_id,
                    "patient_id" => $referral->patient_id
                ]);

                $referral->update(["patient_connection_id" => $patient_connection->id]);

                // dd($patient_connection->toArray());

                # services բազան կառուցելուց հետո այս ցիկլով կմուտքագրենք ծառայությունները ուղեգրի։
                $service_ids = array_filter(array_slice($request->service_id[$d_key], 0, $request->service_wrap_length[$d_key]));
                foreach ($service_ids as $s_key => $service_id) {
                    $payment_type = $request->payment_type[$d_key][$s_key];
                    $comment = $request->comment[$d_key][$s_key];
                    $service_additional_data = compact("payment_type", "comment");

                    $referral->services()->attach($service_id, $service_additional_data);
                }

                $receiver  = User::with('queues')->find($receiver_id);
                $department_workers = User::where('department_id', $department_id)->get();
                if ($receiver) {
                    $last_number = $receiver->queues->last()->number ?? 0;
                    # երբ ուղեգրում ենք կոնկրետ բժշկի, կարող ենք նրա մոտ արդեն հերթագրել
                    # շտապի հարցն է միայն այստեղ բաց, ուղեգրի ֆորման չունի "շտապ" դաշտ
                    Queue::create([
                        'referral_id' => $referral->id,
                        'user_id' => $receiver_id,
                        'number' => $last_number + 1
                    ]);
                    broadcast(new ReferralReceivedEvent($receiver, $referral)); // App.User.{$user_id}
                }

                if (count($department_workers)) {
                    foreach ($department_workers as $worker) {
                        if ($worker->hasAnyRole(['department_head', 'department_registrar'])) {
                            broadcast(new DepartmentReferralReceivedEvent($worker, $referral)); // App.Department.{$department_id}
                        }
                        continue;
                    }
                }
            }

            // քոմենթել՝ արդյունքները տեսնելու համար:
            return back()->withSuccess('Բոլոր ուղեգրերը հաջողությամբ ուղարկված են։');
        } else {
            return back()->withWarning('Ստուգեք՝ արդյո՞ք "Ստացող բաժինը" դաշտը ընտրված է բոլոր ուղեգրերի համար։');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $referral_id
     * @return \Illuminate\Http\Response
     */

    //
    public function show(Request $request,$referral_id)
    {

        /*$referral_id, $user_id*/

        $user = User::findOrFail($request->user_id);
        // return view('stationary.show_page1', compact('patient', 'stationary'));
        if (is_null($user) || is_null($referral_id)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (օգտատեր) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        // if ($this->authorize('is-department-head-or-registrar')) {
        if ($user->can('is-department-head-or-registrar')) {
            $referral = Referral::with(['services'])->findOrFail($referral_id);
            # user->department_id === referral->department_id
            if ($user->department_id !== $referral->department_id) {
                return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ չեն գտնվել։'], 401, [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8'
                ], JSON_UNESCAPED_UNICODE);
            }
        } else {
            $referral = $user->received_referrals()->findOrFail($referral_id);
            if (is_null($referral->opened_at))
                $referral->update(["opened_at" => now()]);
        }

        return response()->json(['data' => $referral], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }


    /**
     * Display the specified resource sent referrals.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function sentShow(Request $request)
    {

//        return response()->json(['request' => $request->all()]);
        $user = User::find($request->user_id);

        if ($user->can('is-department-head')) {
            $referral_id = $request->referral_id;
            $referral = Referral::with(["receiver", "department", "services", "patient", "sender"])->find($referral_id);
            # user->department_id === sender->department_id
            if ($user->department_id !== $referral->sender->department_id) {
                abort(404);
            }

        } else {
            $referral = $user->sent_referrals()
                ->with(["receiver", "department", "services", "patient"])->findOrFail($referral_id);
        }

        return response()->json(['data' => $referral], 200);
        return view("referrals.show_sent", compact("referral"));
    }

    /**
     * Accept received referral
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $referral_id
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request)
    {

        $user = User::find($request->user_id);
        $referral_id = $request->referral_id;
        $referral = Referral::find($referral_id);

        if (is_null($user) || is_null($referral)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ (օգտատեր) չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        if (!is_null($referral->accepted_at)){
            if (is_null($referral->id)) {
                return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ չեն գտնվել։'], 401, [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8'
                ], JSON_UNESCAPED_UNICODE);
            }
        }
          //  return back()->withErrors(["referral" => __('referrals.already_accepted')]);


        $patientConnection = PatientConnection::create([
            "sender_id" => $referral->sender_id,
            "receiver_id" => $referral->receiver_id,
            "patient_id" => $referral->patient_id
        ]);

        $referral->update(["accepted_at" => now(), "patient_connection_id" => $patientConnection->id]);

       // return redirect()->route("patients.show", ["patient" => 1])->withSuccess(__('referrals.accepted'));

        return response()->json(['message' => __('referrals.accepted')], 201, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referral $referral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $referral_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       // dd($referral_id);
        $user = User::find($request->user_id);

        $referral = $user->received_referrals()->find($referral_id);

        if (is_null($referral)) {
            return response()->json(['message' => 'Հարցմանը համապատասխան տվյալներ չեն գտնվել։'], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        if (!is_null($referral->accepted_at)){
            return response()->json(['message' => __('referrals.already_accepted')], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $referral->patient_connection()->delete();
        $referral->delete();

        return response()->json(['message' => __('referrals.deleted')], 201, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

    }

    /**
     * Mark current referral as finished.
     *
     * @param  int  $referral_id
     * @return \Illuminate\Http\Response
     */
    public function finish($referral_id)
    {
        $referral = auth()->user()->received_referrals()->findOrFail($referral_id);

        if (is_null($referral->accepted_at))
            return back()->withErrors(["referral" => __('referrals.not_accepted_yet')]);

        $referral->patient_connection()->delete();
        $referral->update(["finished_at" => now()]);

        return redirect()->route("referrals.patients.received")->withSuccess(__('referrals.finished'));
    }
}
