<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\User;
use App\Models\SubFarm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\FarmStoreRequest;
use Yajra\DataTables\Facades\DataTables;

class FarmController extends Controller
{
    public function index(Request $request)
    {
        // if ($error = $this->authorize('employee-manage')) {
        //     return $error;
        // }
        if ($request->ajax()) {
            $farms = Farm::query();
            return DataTables::of($farms)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    return '<input type="checkbox" name="select[]" onclick="checkcheckbox()" id="check_'.$row->id.'" class="check" value="'.$row->id.'">';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<a href='.route('admin.farm.show', $row->id).' class="mr-2">Add Room</a>';
                    $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.farm.edit', $row->id) , 'row' => $row]);
                    $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.farm.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    // $btn .= '<a href='.route('admin.farm.destroy', $row->id).' class="btn-sm btn btn-danger mb-2"><i class="fa fa-trash" style="vertical-align: middle;"></i></a>';
                    return $btn;
                })
                ->rawColumns(['check', 'action', 'created_at'])
                ->make(true);
        }
        $users = User::whereIn('type',['1','3'])->get(['id','name']);
        return view('admin.farm.index', compact('users'));
    }

    public function store(Request $request,FarmStoreRequest $farmRequest)
    {
        // if ($error = $this->authorize('employee-add')) {
        //     return $error;
        // }
        DB::beginTransaction();
        $data = $farmRequest->validated();
        $farm = Farm::create($data);

        for($r = 1; $r <= $request->total_room; $r++){
            $data['user_id'] = user()->id;
            $data['farm_id'] = $farm->id;
            $data['room_no'] = $r;
            $data['name']    = $farm->name;
            SubFarm::create($data);
        }
        try {
            DB::commit();
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $subFarms = SubFarm::whereFarm_id($id);
            return DataTables::of($subFarms)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    return '<input type="checkbox" name="select[]" onclick="checkcheckbox()" id="check_'.$row->id.'" class="check" value="'.$row->id.'">';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.sub-farm.edit', $row->id) , 'row' => $row]);
                    $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.sub-farm.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    return $btn;
                })
                ->rawColumns(['check', 'action', 'created_at'])
                ->make(true);
        }
        $farm = Farm::find($id);
        return view('admin.sub_farm.index', compact('farm'));
    }


    public function edit(Request $request, Farm $farm)
    {
        // if ($error = $this->authorize('class-room-edit')) {
        //     return $error;
        // }
        if ($request->ajax()) {
            $users = User::whereIn('type',['1','3'])->get(['id','name']);
            $modal = view('admin.farm.edit', compact('users'))->with('farm', $farm,)->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }


    public function update(FarmStoreRequest $request, Farm $farm)
    {
        // if ($error = $this->authorize('class-room-edit')) {
        //     return $error;
        // }
        $data = $request->validated();
        try {
            $farm->update($data);
            return response()->json(['message'=> 'Updated Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
        }
    }

    public function destroy(Farm $farm)
    {
        // if ($error = $this->authorize('class-room-delete')) {
        //     return $error;
        // }
        try {
            SubFarm::whereFarm_id($farm->id)->delete();
            $farm->delete();
            return response()->json(['message'=> 'Deleted Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
