<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\SubFarm;
use App\Models\DailyEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DailyEntryStoreRequest;

class DailyEntryMultiController extends Controller
{
    public function index()
    {
        $dailyEntries = DailyEntry::with(['farm','subFarm'])->orderBy('farm_id')->latest()->get();
        return view('admin.daily_entry_multi.index', compact('dailyEntries'));
    }
    public function create()
    {
        $farms = Farm::all(['id', 'name']);
        return view('admin.daily_entry_multi.create', compact('farms'));
    }

    public function getFarm(Request $request)
    {
        $inputs = SubFarm::whereFarm_id($request->farm_id)->get();
        $subFarms = view('admin.daily_entry_multi.sub_farm', ['inputs' => $inputs])->render();
        return response()->json(['status' => 'success', 'html' => $subFarms, 'subFarms']);
    }

    public function store(Request $request)
    {
        // if ($error = $this->authorize('employee-add')) {
        //     return $error;
        // }
        // $this->$request->validate([
        //     'farm_id' => 'required|integer',
        //     'date'    => 'required|date',
        // ]);
        DB::beginTransaction();
        foreach ($request->sub_farm_id as $k => $v) {
            $data = [
                'user_id'      => user()->id,
                'farm_id'      => $request->farm_id,
                'date'         => $request->date,
                'sub_farm_id'  => $request->sub_farm_id[$k],
                'dead'         => $request->dead[$k],
                'feed'         => $request->feed[$k],
                'balance_feed' => $request->balance_feed[$k],
            ];
            DailyEntry::create($data);
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
