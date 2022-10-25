<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use App\Models\Sales;
use App\Models\DailyEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SalesReportController extends Controller
{
    public function select(Request $request)
    {
        $farms = Farm::all(['id', 'name']);
        return view('admin.report.sales.select', compact('farms'));
    }

    public function report(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        // return$sales = Sales::with(['farm','subFarm'])
        return$sales = DB::table('sales')
                            ->select('daily_entries.id','daily_entries.farm_id','daily_entries.status','daily_entries.sub_farm_id','daily_entries.dead', 'sales.id','sales.farm_id','sales.sub_farm_id','sales.status','sales.date','sales.do','sales.crete','sales.quantity')
                            ->join('daily_entries', 'sales.sub_farm_id', '=', 'daily_entries.sub_farm_id')
                            // ->join('daily_entries', 'sales.farm_id', '=', 'daily_entries.farm_id')
                            ->where('sales.farm_id',$request->farm_id)
                            ->where('sales.status',0)
                            ->where('daily_entries.status',0)
                            ->orderBy('sales.sub_farm_id')
                            ->get();

        // $dailyEntries = DailyEntry::with(['farm','subFarm'])
        //                     ->whereFarm_id($request->farm_id)
        //                     ->whereStatus(0)
        //                     ->orderBy('sub_farm_id')
        //                     ->get();

        return view('admin.report.sales.report', compact('sales','dailyEntries','start_date','end_date'));

    }
}
