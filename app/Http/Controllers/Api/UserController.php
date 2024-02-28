<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Patient;

class UserController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|exists:users,username',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $user = User::where('username', $request->username)->first();

        if ($user->account_suspended) {
            return response()->json(['errors' => ['message' => ["Մուտքագրված տվյալներով օգտատեր չի գտնվել:"]]], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        if (Hash::check($request->input('password'), $user->password)) {

            $auth_token = encrypt($user->username);
            // return response()->json(['token_encrypt' => $auth_token], 200);
            return response()->json(
                [
                    'data' => [
                        'user' => $user,
                        'meta' => [
                            'auth_token' => $auth_token,
                            'user_id' => $user->id
                        ]
                    ],

                ],
                200,
                [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8'
                ],
                JSON_UNESCAPED_UNICODE
            );
            // return response()->json(['data' => $user], 200);
        }

        return response()->json(['errors' => ['message' => ["Մուտքագրված տվյալներերը անվավեր են:"]]], 401, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $user_id
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function patients(Request $request, $user_id)
    {

        $with_pagination = $request->get('with_pagination', 0);
        $user = User::find($user_id);
        if (is_null($user)) {
            return response()->json(['errors' => ['message' => ["Հարցմանը համապատասխան տվյալներ (բժիշկ) չեն գտնվել։"]]], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        # Թեսթերի համար վերցնենք ընդունարանի աշխատողին, ու ըստ իրա վերցնենք
        # հնարավոր  (համարայա-թե) բոլոր հիվանդներին՝ էջակալումը ճշգրտելու համար։
        $user_receptionist = User::where('username', 'araqsya.poghosyan')->first();

        $patients = null;
        if (intval($with_pagination) === 1) {
            $patients = Patient::availablePatientsTwoApi($user)->paginate(2);
        } else {
            $patients = Patient::availablePatientsTwoApi($user)->get();
        }

        // $patients = Patient::availablePatientsTwoApi($user_receptionist)->paginate(2);
        // $patients = Patient::availablePatientsTwoApi($user_receptionist)->get();
        return response()->json(['data' => $patients], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param mixed $user_id
     * @param mixed $patient_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function patient(Request $request, $user_id, $patient_id)
    {

        $user = User::find($user_id);
        $patient = Patient::find($patient_id);

        if (is_null($user)) {
            return response()->json(['errors' => ['message' => ["Հարցմանը համապատասխան տվյալներ (բժիշկ) չեն գտնվել։"]]], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        if (is_null($patient)) {
            return response()->json(['errors' => ['message' => ['Հարցմանը համապատասխան տվյալներ (հիվանդ) չեն գտնվել։']]], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $patient_with_relations = Patient::with(Patient::samples_relations())->find($patient->id);
        $patient_samples = Patient::get_patient_samples($patient_with_relations);

        return response()->json(['data' => ['patient' => $patient,  'history' => $patient_samples]], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
}
