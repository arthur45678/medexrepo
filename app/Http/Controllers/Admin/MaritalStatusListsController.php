<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LabServiceList;
use App\Models\MaritalStatusList;
use Illuminate\Http\Request;

class MaritalStatusListsController extends Controller
{
    public function index()
    {
        $lists = MaritalStatusList::all();
        return  view('admin.marital-status-lists.index', compact('lists'));
    }
    public function create()
    {
        return  view('admin.marital-status-lists.create');
    }
    public function store(Request $request)
    {
        $v = $this->validate($request, [
            'name' => 'required',
        ]);
        MaritalStatusList::create($request->all());
        return redirect()->route('admin.marital-status-lists.index')->with('msg','ok');
    }
    public function edit($id)
    {
        $item = MaritalStatusList::find($id);
        return view('admin.marital-status-lists.edit',compact('item'));
    }
    public function update(Request $request, $id)
    {
        if ($request->name != '') {
            MaritalStatusList::find($id)->update([
                'name' => $request->name,
                'status' => $request->status
            ]);
        } else {
            if ($request->status == 'active') {
                MaritalStatusList::find($id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                MaritalStatusList::find($id)->update([
                    'status' => 'active'
                ]);
            }

        }
        return redirect()->route('admin.marital-status-lists.index')->with('success','Թարմացվեց');
    }
}
