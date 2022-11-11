<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use Illuminate\Http\Request;
use App\Models\PersonalSales;
use App\Http\Controllers\Controller;

class PersonalSalesReportController extends Controller
{
    public function select(Request $request)
    {
        $farms = Farm::all(['id', 'name']);
        return view('admin.report.personal_sales.select', compact('farms'));
    }

    public function report(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        // return$datum = DailyEntry::with('farm','subFarm', 'purchase')->whereFarm_id($request->farm_id)->get();
        $reports = PersonalSales::with(['customer','farm','subFarm'])
                            ->whereFarm_id($request->farm_id)
                            ->whereSub_farm_id($request->sub_farm_id)
                            // ->whereStatus(0)
                            // ->orderBy('sub_farm_id')
                            ->get();

        return view('admin.report.personal_sales.report', compact('reports','start_date','end_date'));

    }
}
