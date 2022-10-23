<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\SubFarm;
use App\Models\DailyEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DailyEntryStoreRequest;

class DailyEntryController extends Controller
{
    public function create()
    {
        $farms = Farm::all(['id', 'name']);
        return view('admin.daily_entry.create', compact('farms'));
    }

    public function getFarm(Request $request)
    {
        $inputs = SubFarm::whereFarm_id($request->farm_id)->get();
        $subFarms = view('admin.daily_entry.sub_farm', ['inputs' => $inputs])->render();
        return response()->json(['status' => 'success', 'html' => $subFarms, 'subFarms']);
    }

    public function store(DailyEntryStoreRequest $request)
    {
        // if ($error = $this->authorize('employee-add')) {
        //     return $error;
        // }
        DB::beginTransaction();
        $data = $request->validated();
        $data['user_id'] = user()->id;
        DailyEntry::create($data);
        try {
            DB::commit();
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
