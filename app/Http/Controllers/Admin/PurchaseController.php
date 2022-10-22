<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\SubFarm;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('admin.purchase.create');
    }

    public function create()
    {
        $suppliers = Supplier::all(['id', 'name']);
        $farms = Farm::all(['id', 'name']);
        return view('admin.purchase.create', compact('suppliers','farms'));
    }

    public function getFarm(Request $request)
    {
        $inputs = SubFarm::whereFarm_id($request->farm_id)->get();
        $subFarms = view('admin.purchase.sub_farm', ['inputs' => $inputs])->render();
        return response()->json(['status' => 'success', 'html' => $subFarms, 'subFarms']);
    }
}
