<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\SubFarm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubFarmController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        $data['user_id'] = user()->id;
        $data['farm_id'] = $request->farm_id;
        $data['room_no'] = SubFarm::whereFarm_id($request->farm_id)->max('room_no') + 1;
        $data['name']    = Farm::find($request->farm_id)->name;
        SubFarm:: create($data);
        try {
            DB::commit();
            return response()->json(['message' => 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }


    public function edit(Request $request, Farm $farm)
    {
        // if ($error = $this->authorize('class-room-edit')) {
        //     return $error;
        // }
        if ($request->ajax()) {
            $users = User::whereIn('type', ['1', '3'])->get(['id', 'name']);
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
            return response()->json(['message' => 'Updated Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
        }
    }

    public function destroy(SubFarm $farm)
    {
        // if ($error = $this->authorize('class-room-delete')) {
        //     return $error;
        // }
        try {
            $farm->delete();
            return response()->json(['message' => 'Deleted Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => __('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
