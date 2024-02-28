<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarships_list;
use Illuminate\Http\Request;

class ScholarshipsListsController extends Controller
{
    public function index()
    {
        $lists = Scholarships_list::all();
        return  view('admin.scholarships-lists.index', compact('lists'));
    }
    public function create()
    {
        return  view('admin.scholarships-lists.create');
    }
    public function store(Request $request)
    {
        $v = $this->validate($request, [
            'name' => 'required',
        ]);
        Scholarships_list::create($request->all());
        return redirect()->route('admin.scholarships-lists.index')->with('msg','ok');
    }
    public function edit($id)
    {
        $item = Scholarships_list::find($id);
        return view('admin.scholarships-lists.edit',compact('item'));
    }
    public function update(Request $request, $id)
    {
        if ($request->name != '') {
            Scholarships_list::find($id)->update([
                'name' => $request->name,
                'status' => $request->status
            ]);
        } else {
            if ($request->status == 'active') {
                Scholarships_list::find($id)->update([
                    'status' => 'inactive'
                ]);
            } else {
                Scholarships_list::find($id)->update([
                    'status' => 'active'
                ]);
            }

        }
        return redirect()->route('admin.scholarships-lists.index')->with('success','Թարմացվեց');
    }
}
