<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\ServiceList;
use Illuminate\Http\Request;

use App\Models\StateOrderedService;
use App\Models\PaidService;

class ServiceListController extends Controller
{
    /**
     * Returns unique column k1 from paid_services table
     * url: /catalogs/paid_services_k1.json
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaidService  $paid_services
     * @return \Illuminate\Http\Response
     */
    public function paid_services_k1_json(
        Request $request,
        PaidService $paid_services
    ) {
        $key_one_services = $paid_services->get()->unique('key_one')->values();
        return response()->json($key_one_services);
    }

    /**
     * Returns unique column k2 from paid_services table grouped by key_one
     * url: /catalogs/paid_services_k2.json
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaidService  $paid_services
     * @return \Illuminate\Http\Response
     */
    public function paid_services_k2_json(
        Request $request,
        PaidService $paid_services
    ) {
        $key_one = $request->key_one ?? false;
        $key_two_services = $paid_services->when($key_one, function ($key_two_services) use ($key_one) {
            return $key_two_services->where('key_one', $key_one);
        })->where('key_two', '!=', '')->get(); //
        $keys_two_unique = collect($key_two_services)->unique('key_two')->values();
        return response()->json($keys_two_unique);
    }

    public function paid_services_json(
        Request $request,
        PaidService $paid_services
    ) {
        // catalogs/paid_services.json
        $key_one = $request->key_one ?? false;
        $key_two = $request->key_two ?? false;
        $filtered_paid_services = $paid_services->when( $key_one, function($filtered_paid_services) use($key_one){
            return $filtered_paid_services->where('key_one', $key_one);
        })->when( true, function($filtered_paid_services) use($key_two) {
            return $filtered_paid_services->where('key_two', $key_two);
        })->get();
        return response()->json($filtered_paid_services);
    }


    public function state_ordered_services_json(
        Request $request,
        StateOrderedService $state_ordered_services
    ) {
        return response()->json($state_ordered_services->get());
    }





    /**
     * First created old service-list model ServiceList
     */

    public function services_json(Request $request, ServiceList $serviceList)
    {
        return response()->json($serviceList->search($request->q ?? ""));
    }

    public function services_full_json(Request $request, ServiceList $serviceList)
    {
        $all = $serviceList::select('id',  'code', 'name', 'price', 'department_id')->get();

        if ($request->filled('filterBy') && $request->filled('needle')) {
            $needle = $request->needle;
            $filterBy = $request->filterBy;
            $filtered = $all->filter(function ($value, $key) use ($filterBy, $needle) {
                return $value[$filterBy] == $needle;
            });
            // return response()->json(array_values($filtered->toArray()));
            return response()->json($filtered->values());
        }
        return $all;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceList $serviceList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceList $serviceList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceList $serviceList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceList $serviceList)
    {
        //
    }
}
