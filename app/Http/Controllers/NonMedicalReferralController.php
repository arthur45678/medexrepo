<?php

namespace App\Http\Controllers;

use App\Events\DepartmentReferralReceivedEvent;
use App\Events\NonMedicalDepartmentReferralReceivedEvent;
use App\Events\NonMedicalReferralReceivedEvent;
use App\Events\ReferralReceivedEvent;
use App\Http\Requests\Samples\NonMedicalReferenceRequest;
use App\Models\NonMedicalReferral;
use App\Models\Queue;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Contracts\Models\HasAttachments;



class NonMedicalReferralController extends Controller
{

    public function attachments()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("nonmedical-referrals.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $repeatables = 5;
        $data_limit = 10;
        return view("nonmedical-referrals.create")
            ->with(compact("repeatables", "data_limit"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $department_ids = array_filter(array_slice($request->department_id, 0, $request->referral_wrap_length));
        if (count($department_ids)) {


            $user_id = $user->id;

            foreach ($department_ids as $d_key => $department_id) {

                $receiver_id = $request->receiver_id[$d_key];
                $sender_id = auth()->id();

                $referral_data = compact("department_id", "receiver_id", "sender_id", "user_id");
                $referral = NonMedicalReferral::create($referral_data); // save Referral +

                $receiver  = User::find($receiver_id); // +
                $department_workers = User::where('department_id', $department_id)->get();

                if ($receiver) {
                    $attachments = $request->attachments[$d_key];
                    $this->storeAttachmentsForUser($request, $referral, $receiver, '$attachments', true, $attachments);
                    // broadcast(new NonMedicalReferralReceivedEvent($receiver, $referral)); // App.User.{$user_id}
                }

                if (count($department_workers)) {
                    foreach ($department_workers as $worker) {
                        if ($worker->hasAnyRole(['department_head', 'department_registrar'])) {
                            broadcast(new NonMedicalDepartmentReferralReceivedEvent($worker, $referral)); // App.Department.{$department_id}
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


    private function storeAttachmentsForUser(
        Request $request,
        HasAttachments $model,
        User $user,
        string $key = "attachments",
        bool $multiple = true,
        array $attachments2 = []
    ) {


        $files = $request->file('attachments');

        //        $user = Auth::user();
        //     if (!$request->hasFile($key)) return false;


        $class_name = class_basename(get_class($model));



        //  $files = $request->file($key);

        $attachments = [];


        if (!$multiple) $files = [$files];

        foreach ($files as $i => $fileItem) {
            foreach ($fileItem as $n => $attachment) {

                $attachment_name = pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME) .  time() . "." . $attachment->getClientOriginalExtension();


                $directory = "/public/user/{$user->id}/{$class_name}";

                $attachment->storePubliclyAs($directory, $attachment_name);
                if ($request->has("attachment_comments")) {
                    $attachment_comment = $request->attachment_comments[$i][$n];

                    array_push($attachments, $model->attachments()->create(compact("attachment_name", "attachment_comment", "directory")));
                } else {
                    array_push($attachments, $model->attachments()->create(compact("attachment_name", "directory")));
                }
            }
        }

        return $attachments;
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
