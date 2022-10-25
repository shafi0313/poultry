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
    public function index()
    {
        $dailyEntries = DailyEntry::with(['farm','subFarm'])->orderBy('farm_id')->latest()->get();
        return view('admin.daily_entry.index', compact('dailyEntries'));
    }
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
        if(DailyEntry::whereDate('date',$request->date)->whereFarm_id($request->farm_id)->whereSub_farm_id($request->sub_farm_id)->first()){
            DailyEntry::whereDate('date',$request->date)->whereFarm_id($request->farm_id)->whereSub_farm_id($request->sub_farm_id)->update($data);
        }else{
            DailyEntry::create($data);
        }
        $dailyEntryCheck = DailyEntry::whereDate('date',$request->date)->whereFarm_id($request->farm_id)->get('sub_farm_id');
        $subFarms = SubFarm::whereFarm_id($request->farm_id)->whereNotIn('id',$dailyEntryCheck)->get()->pluck('id');
        foreach($subFarms as $subFarm){
            $nullData = [
                'user_id' => user()->id,
                'farm_id' => $request->farm_id,
                'sub_farm_id' => $subFarm,
                'date' => $request->date,
                'dead' => 0,
                'feed' => 0,
            ];
            DailyEntry::create($nullData);
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
}
