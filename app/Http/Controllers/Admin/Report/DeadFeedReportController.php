<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use App\Models\DailyEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeadFeedReportController extends Controller
{
    public function select(Request $request)
    {
        $farms = Farm::all(['id', 'name']);
        return view('admin.report.dead_feed.select', compact('farms'));
    }

    public function report(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        // return$datum = DailyEntry::with('farm','subFarm', 'purchase')->whereFarm_id($request->farm_id)->get();
        $dailyEntries = DailyEntry::with(['farm','subFarm'])
                            ->whereFarm_id($request->farm_id)
                            ->whereStatus(0)
                            ->orderBy('sub_farm_id')
                            ->get();

        return view('admin.report.dead_feed.report', compact('dailyEntries','start_date','end_date'));

    }
}
