<?php

namespace App\Http\Controllers\Admin\Report;

use Carbon\Carbon;
use App\Models\Farm;
use App\Models\Purchase;
use App\Models\DailyEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DailyEntryReportController extends Controller
{
    public function select(Request $request)
    {
        $farms = Farm::all(['id', 'name']);
        return view('admin.report.daily_entry.select', compact('farms'));
    }

    public function report(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        // return $request->date;
        // return$datum = DailyEntry::with('farm','subFarm', 'purchase')->whereFarm_id($request->farm_id)->get();
        $dailyEntries = DailyEntry::with(['farm','subFarm'])
                            ->whereFarm_id($request->farm_id)
                            ->where('date',$start_date)
                            ->whereStatus(0)->get();

        // $purchases = Purchase::with(['farm','subFarm', 'dailyEntries'])
        //                     ->whereFarm_id($request->farm_id)
        //                     ->whereStatus(0)->get();
        return view('admin.report.daily_entry.report', compact('dailyEntries','start_date'));

    }
}
