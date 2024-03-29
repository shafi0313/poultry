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
        $sales = Sales::with(['farm','subFarm'])
            ->select('daily_entries.id', 'daily_entries.farm_id', 'daily_entries.sub_farm_id', 'daily_entries.date as d_date', 'daily_entries.status', 'daily_entries.dead', 'daily_entries.feed',
            'sales.id', 'sales.farm_id', 'sales.sub_farm_id', 'sales.status', 'sales.date', 'sales.do', 'sales.crate', 'sales.quantity',
            'purchases.chicken', 'purchases.feed as p_feed', 'purchases.date as p_date')
            ->join('daily_entries', function($join) use ($start_date, $end_date) {
                $join->on('sales.farm_id', '=', 'daily_entries.farm_id')
                ->on('sales.sub_farm_id', '=', 'daily_entries.sub_farm_id')
                ->whereBetween('daily_entries.date', [$start_date, $end_date]);
            })
            ->join('purchases', function($join){
                $join->on('sales.farm_id', '=', 'purchases.farm_id')
                ->on('sales.sub_farm_id', '=', 'purchases.sub_farm_id');
            })
            ->where('sales.farm_id', $request->farm_id)
            ->where('sales.status', 0)
            ->where('daily_entries.status', 0)
            ->where('purchases.status', 0)
            ->orderBy('sales.sub_farm_id')
            ->get();
        return view('admin.report.sales.report', compact('sales', 'start_date', 'end_date'));
    }
}
