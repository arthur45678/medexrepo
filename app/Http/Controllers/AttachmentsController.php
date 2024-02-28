<?php

namespace App\Http\Controllers;

use App\Models\Attachable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentsController extends Controller
{
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
     * @param  \App\Models\Attachable  $attachable
     * @return \Illuminate\Http\Response
     */
    public function show(Attachable $attachable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attachable  $attachable
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachable $attachable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attachable  $attachable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachable $attachable)
    {
        //
    }

    /**
     * Soft-delete the specified resource from storage.
     *
     * @param  \App\Models\Attachable  $attachable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Attachable $attachable)
    {
        if (auth()->id() !== $attachable->user_id)
            return abort(401);
        // Storage::delete($attachable->attachment_name); // դեռ չեն ուզում ջնջել դիսկի վրից:
        $attachable->delete();

        if ($request->ajax()) {
            return response()->json(["success" => true]);
        }
        return back()->withSuccess(__("patients.delete_file_success"));
    }
}
