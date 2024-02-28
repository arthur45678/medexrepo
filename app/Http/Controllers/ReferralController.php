<?php

namespace App\Http\Controllers;

use App\Models\Calendar\CalendarModel;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Referral;
use App\Models\Patient;

use App\Events\ReferralReceivedEvent;
use App\Events\DepartmentReferralReceivedEvent;
use App\Models\PatientConnection;
use App\Models\Queue;

use App\Models\PaidService;
use App\Models\StateOrderedService;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receivedReferrals = auth()->user()->received_referrals()->get();
        return view("referrals.received", compact("receivedReferrals"));
    }

    /**
     * Display a listing of the received resources.
     *
     * @return \Illuminate\Http\Response
     */
    // received referrals - PERSONAL (Ստացածներ [-> Անձնական])
    public function receivedIndex(Request $request)
    {
        if ($request->ajax()) {
            $receivedReferrals = auth()->user()->received_referrals()->with(["sender", "sender.department"])->orderBy("opened_at")->limit(20)->get();
            $receivedReferralsCount = $receivedReferrals->count() ?? 0;
            $unopenedReferralsCount = $receivedReferrals->where("opened_at", null)->count();

            if ($request->get('getCount', 0) == 1) {
                return response()->json(compact('receivedReferralsCount'));
            }
            return response()->json(compact("receivedReferrals", "unopenedReferralsCount"));
        }

        $receivedReferrals = auth()->user()->received_referrals()->with(["sender", "sender.department", "referral_services", "referral_services.serviceable", "patient" => function ($q) {
            $q->setEagerLoads([]);
        }])->latest()->get();

        return view("referrals.received", compact("receivedReferrals"));
    }

    // received but not assigned - DEPARTMENT (Ստացածներ -> Բաժին)
    public function receivedNotAssigned(Request $request)
    {
        $this->authorize('is-department-head-or-registrar');
        $receivedReferrals = Referral::where([
            ['department_id', '=', auth()->user()->department_id],
            ['receiver_id', '=', null]
        ])->with(["sender", "sender.department", "referral_services", "patient"])->latest()->get();
        $assigned_to = "not_assigned";
        return view("referrals.received_others", compact("receivedReferrals", "assigned_to"));
    }

    // received and assigned to anyone - DOCTOR  (Ստացածներ -> Բժիշկներ)
    public function receivedAssigned(Request $request)
    {
        $this->authorize('is-department-head-or-registrar');
        $receivedReferrals = Referral::where([
            ['department_id', '=', auth()->user()->department_id],
            ['receiver_id', '<>', null],
            ['receiver_id', '<>', auth()->id()],
        ])->with(["sender", "sender.department", "referral_services", "referral_services.serviceable", "patient", "receiver"])->latest()->get();
        // dd($receivedReferrals);
        $assigned_to = "assigned";
        return view("referrals.received_others", compact("receivedReferrals", "assigned_to"));
    }

    public function servicesIndex()
    {
        $referrals = auth()->user()->received_referrals()->where("finished_at", "!=", null)->with([
            "referral_services", "referral_services.serviceable",
            "sender", "sender.department",
            "patient" => function ($q) {
                $q->setEagerLoads([]);
            }
        ])->latest()->get();

        # Передача по ссылке
        # Вы можете передать переменную в функцию по ссылке, чтобы она могла изменять значение аргумента
        $referral_services = [];
        $referrals->map(function ($referral) use (&$referral_services) {
            $referral->referral_services->map(function ($ref_service) use ($referral, &$referral_services) {
                # мутация обьекта $service добавнением двух свойст
                $ref_service->patient = $referral->patient;
                $ref_service->sender = $referral->sender;
                $referral_services[] = $ref_service;
            });
        });
        return view('referrals.services', compact('referral_services'));
    }

    /**
     * Display a listing of the sent resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sentIndex(Request $request)
    {
        $sentReferrals = auth()->user()->sent_referrals()
            ->with([
                "receiver", "department",
                "referral_services", "referral_services.serviceable",
                "patient" => function ($q) {
                    $q->setEagerLoads([]);
                }
            ])->latest()->get();
        $sentReferralsCount = $sentReferrals->count();

        if ($request->ajax()) {
            if ($request->get('getCount', 0) == 1) return response()->json(compact("sentReferralsCount"));
            return response()->json(compact("sentReferrals"));
        }
        return view("referrals.sent_dtajax", compact("sentReferrals"));
    }

    /**
     * Display a listing of the sent resource by other users.
     *
     * @return \Illuminate\Http\Response
     */
    public function sentOthers(Request $request)
    {
        $this->authorize('is-department-head');

        $department_workers_ids = User::where('department_id', auth()->user()->department_id)
        ->where('id', '<>', auth()->id())->pluck('id');
        $sentReferrals = Referral::whereIn('sender_id', $department_workers_ids)
            ->with(["receiver", "department", "referral_services", "referral_services.serviceable", "patient", "sender"])->latest()->get();

        return view("referrals.sent_others", compact("sentReferrals"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $repeatables = 5;
        $data_limit = 10;
        $paid_services = PaidService::paginate(5)->toArray()['data'];
        $state_ordered_services = StateOrderedService::paginate(10)->toArray()['data'];

        return view("referrals.create")->with(compact(
            "patient",
            "repeatables",
            "data_limit",
            "paid_services",
            "state_ordered_services"
        ));
    }


    # only for new services development
    public function create_service_dev(Patient $patient)
    {
        $repeatables = 5;
        $data_limit = 10;
        $paid_services = PaidService::get(); //paginate(5)->toArray()['data'];//get();//
        $state_ordered_services = StateOrderedService::get(); //paginate(10)->toArray()['data'];//get();//
        // dd($state_ordered_services);

        return view("referrals.devment.create_service_dev")->with(compact(
            "patient",
            "repeatables",
            "data_limit",
            "paid_services",
            "state_ordered_services"
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient
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
                return back()
                    ->withWarning('Ստուգեք՝ արդյո՞ք "Ծառայություն" դաշտը ընտրված է բոլոր ուղեգրերի համար')
                    ->withInput();
            }


            foreach ($department_ids as $d_key => $department_id) {
                $patient_id = $patient->id;
                $receiver_id = $request->receiver_id[$d_key];
                $calendar_id = $request->calendar_id[$d_key];
                $sender_id = auth()->id();
                $referral_data = compact("department_id", "receiver_id", "sender_id", "patient_id", "calendar_id");

                $referral = Referral::create($referral_data); // save Referral

                # ամեն ուղեգրին իրա քոննեքշընը - նախորոք, թեկուզ receiver_id-ն null-ով։
                # եթե receiver_id-ն null-է, այն թարմացնում ենք հերթագրման ժամանակ

                // $patient_connection = $referral->patient_connection()->create([
                //     "sender_id" => $referral->sender_id,
                //     "receiver_id" => $referral->receiver_id,
                //     "patient_id" => $referral->patient_id
                // ]);

                // $referral->update(["patient_connection_id" => $patient_connection->id]);

                // dd($patient_connection->toArray());

                # services բազան կառուցելուց հետո այս ցիկլով կմուտքագրենք ծառայությունները ուղեգրի։
                $service_ids = array_filter(array_slice($request->service_id[$d_key], 0, $request->service_wrap_length[$d_key]));
                foreach ($service_ids as $s_key => $service_id) {
                    $payment_type = $request->payment_type[$d_key][$s_key];
                    $comment = $request->comment[$d_key][$s_key];
                    $service_additional_data = compact("payment_type", "comment");

                    # Old services from single table "service_lists" - վերջում քոմենթել
                    // $referral->services()->attach($service_id, $service_additional_data);

                    // Start new code for morph services
                    if ($payment_type === 'state_order') {
                        $state_ordered_service = StateOrderedService::find($service_id);
                        $state_ordered_service->referral_service()->create([
                            'referral_id' => $referral->id,
                            'payment_type' => $payment_type,
                            'comment' => $comment
                        ]);
                    } else {
                        $paid_service = PaidService::find($service_id);
                        $paid_service->referral_service()->create([
                            'referral_id' => $referral->id,
                            'payment_type' => $payment_type,
                            'comment' => $comment
                        ]);
                    }
                    // End new code for morph services

                }

                $receiver = User::with('queues')->find($receiver_id);
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
                    CalendarModel::create([
                        'referral_id' => $referral->id,
                        'user_id' => $referral->receiver_id,
                        'start' => $referral_data['calendar_id'],
                        'patient_id' => $patient_id
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
            return back()
                ->withWarning('Ստուգեք՝ արդյո՞ք "Ստացող բաժինը" դաշտը ընտրված է բոլոր ուղեգրերի համար։')
                ->withInput();
        }
    }

    /**
     * Display the specified received resource.
     *
     * @param int $referral_id
     * @return \Illuminate\Http\Response
     */
    public function show($referral_id)
    {
        if (auth()->user()->can('is-department-head-or-registrar')) {
            // $referral = Referral::with(['services', 'referral_services', 'referral_services.serviceable'])->findOrFail($referral_id);
            $referral = Referral::findOrFail($referral_id);
            # user->department_id === referral->department_id
            if (auth()->user()->department_id !== $referral->department_id) {
                abort(404);
            }
        } else {
            $referral = auth()->user()->received_referrals()->findOrFail($referral_id);
            if (is_null($referral->opened_at)) {
                $referral->update(["opened_at" => now()]);
            }
        }

        $calendar = CalendarModel::where('user_id',$referral->receiver_id)->where('referral_id', $referral->id)->first();
        return view("referrals.show", compact("referral", 'calendar'));
    }



    /**
     * Display the specified sent resource.
     *
     * @param int $referral_id
     * @return \Illuminate\Http\Response
     */
    public function sentShow($referral_id)
    {
        if (auth()->user()->can('is-department-head')) {
            $referral = Referral::with(["receiver", "department", "referral_services", "referral_services.serviceable", "patient", "sender"])->findOrFail($referral_id);
            // $referral = Referral::findOrFail($referral_id);
            # user->department_id === sender->department_id
            if (auth()->user()->department_id !== $referral->sender->department_id) {
                abort(404);
            }
        } else {
            $referral = auth()->user()->sent_referrals()
                ->with(["receiver", "department", "referral_services", "referral_services.serviceable", "patient"])->findOrFail($referral_id);
        }

        return view("referrals.show_sent", compact("referral"));
    }

    /**
     * Accept received referral
     *
     * @param \Illuminate\Http\Request $request
     * @param int $referral_id
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request, $referral_id)
    {

        $cl = CalendarModel::where('referral_id', $referral_id);
        $referral = auth()->user()->received_referrals()->findOrFail($referral_id);
        if (!is_null($referral->accepted_at))
            return back()->withErrors(["referral" => __('referrals.already_accepted')]);


        // $patientConnection = PatientConnection::where([
        //     ["sender_id", "=",$referral->sender_id],
        //     ["receiver_id", "=",$referral->receiver_id],
        //     ["patient_id", "=", $referral->patient_id]
        // ])->first();
        $patientConnection = PatientConnection::create([
            "sender_id" => $referral->sender_id,
            "receiver_id" => $referral->receiver_id,
            "patient_id" => $referral->patient_id
        ])->first();

        $referral->update(["accepted_at" => now(), "patient_connection_id" => $patientConnection->id]);
        // $referral->update(["accepted_at" => now()]);
        $cl->update(['status' => 'active']);
        return redirect()->route("patients.show", ["patient" => $referral->patient_id])->withSuccess(__('referrals.accepted'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Referral $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referral $referral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $referral_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($referral_id)
    {
        $referral = auth()->user()->received_referrals()->findOrFail($referral_id);
        if (!is_null($referral->accepted_at))
            return back()->withErrors(["referral" => __('referrals.already_accepted')]);

        Queue::where('referral_id', '=', $referral_id)->delete();
        $referral->services()->detach();
        $referral->referral_services()->delete();
        $referral->patient_connection()->delete();
        $referral->delete();

        return redirect()->route("referrals.patients.received")->withSuccess(__('referrals.deleted'));
    }

    /**
     * Mark current referral as finished.
     *
     * @param int $referral_id
     * @return \Illuminate\Http\Response
     */
    public function finish($referral_id)
    {
        $referral = auth()->user()->received_referrals()->findOrFail($referral_id);

        if (is_null($referral->accepted_at))
            return back()->withErrors(["referral" => __('referrals.not_accepted_yet')]);

        Queue::where('referral_id', '=', $referral_id)->delete();
        $patientConnection = PatientConnection::where('id', $referral->patient_connection_id)->first();
        $referral->update(['patient_connection_id' => null, "finished_at" => now()]);
        $patientConnection->delete();
        return redirect()->route("referrals.patients.received")->withSuccess(__('referrals.finished'));
    }


    public function UpdateDate(Request $request)
    {

        $call = CalendarModel::find($request->calendar_id);
        if ($request->calendar_id) :

            $call->update([
                'start' => $request->start,
                'end' => $request->end,
                'referral_id' => $request->referral_id,
                'comments' => $request->description,
            ]);
        else :
            $call = CalendarModel::create([
                'start' => $request->start,
                'end' => $request->end,
                'referral_id' => $request->referral_id,
                'user_id' => auth()->id(),
                'comments' => $request->description,

            ]);
        endif;
        return back();
    }
}
