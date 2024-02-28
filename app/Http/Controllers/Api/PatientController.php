<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Patient;
use App\Models\Patient as Paty;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class PatientController extends Controller
{

    public function login(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|exists:api_patients,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $patient = Patient::where('email', $request->email)->first();
        if (Hash::check($request->input('password'), $patient->password)) {
            return response()->json(['data' => $patient], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['errors' => ["message" => ["Մուտքագրված տվյալներերը անվավեր են:"]]], 401, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

        /**
         * response
         * {"data":{"id":2,"email":"sipan@gmail.com","phone":"0980000076","soc_card":"2000000076","full_name":"Sipan Sipoyan"}}
         */
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|min:2',
            'l_name' => 'required|string|min:2',
            'phone' => 'required|string|max:16|min:8|unique:api_patients,phone',
            'soc_card' => 'required|numeric|unique:api_patients,soc_card',
            'email' => 'required|email|unique:api_patients,email',
            'password' => 'required|string|min:8',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        if ($request->f_name === $request->l_name) {
            return response()->json(["errors" => ["l_name" => "Ազգանուն և Անուն դաշտերը չեն կարող լինել նույնը։"]], 401, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $input = $request->except([
            'password',
            'c_password'
        ]);
        $input['password'] = bcrypt($request->password);
        // return response()->json(['data' => $input], 201);


        $patient = Patient::create($input);
        return response()->json(["data" => $patient], 201, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);

        /**
         * response
         * {"data":{"email":"sipan@gmail.com","soc_card":"2000000076","phone":"0980000076","id":2,"full_name":"Sipan Sipoyan"}}
         */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Patient::all();
        // return response()->json(Patient::get(), 200);
        // return response()->json(Paty::get(), 200);
        // return Paty::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        if (is_null($patient)) {
            return response()->json(['errors' => ['message' => ['Հարցմանը համապատասխան օգտատեր չի գտնվել։']]], 404, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
        return response()->json(['data' => $patient], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
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
        $patient = Patient::find($id);
        if (is_null($patient)) {
            return response()->json(['errors' => ['message' => ['Հարցմանը համապատասխան օգտատեր չի գտնվել։']]], 404, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }

        $patient->fill($request->all())->save();
        return response()->json(['data' => $patient], 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        if (is_null($patient)) {
            return response()->json(['errors' => ['message' => ['Հարցմանը համապատասխան օգտատեր չի գտնվել։']]], 404, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        }
        $patient->delete();
        return response()->json(null, 204, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE);
    }
}
