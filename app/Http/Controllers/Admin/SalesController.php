<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Sales;
use App\Models\SubFarm;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalesStoreRequest;
use RealRashid\SweetAlert\Facades\Alert;

class SalesController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        $suppliers = Supplier::all(['id', 'name']);
        $farms = Farm::all(['id', 'name']);
        return view('admin.sales.create', compact('suppliers','farms'));
    }

    public function getSubFarm(Request $request)
    {
        $inputs = SubFarm::whereFarm_id($request->farm_id)->get();
        $subFarms = view('admin.sales.sub_farm', ['inputs' => $inputs])->render();
        return response()->json(['status' => 'success', 'html' => $subFarms, 'subFarms']);
    }

    public function store(Request $request)
    {
        // DB::beginTransaction();
        // $data = $request->validated();
        // $data['user_id'] = user()->id;
        // if(Sales::whereDo($request->do)->whereFarm_id($request->farm_id)->whereSub_farm_id($request->sub_farm_id)->first()){
        //     Sales::whereDo($request->do)->whereFarm_id($request->farm_id)->whereSub_farm_id($request->sub_farm_id)->update($data);
        // }else{
        //     Sales::create($data);
        // }
        // $dailyEntryCheck = Sales::whereDo($request->do)->whereFarm_id($request->farm_id)->get('sub_farm_id');
        // $subFarms = SubFarm::whereFarm_id($request->farm_id)->whereNotIn('id',$dailyEntryCheck)->get()->pluck('id');
        // foreach($subFarms as $subFarm){
        //     $nullData = [
        //         'user_id'       => user()->id,
        //         // 'supplier_id'   => $request->supplier_id,
        //         'farm_id'       => $request->farm_id,
        //         'sub_farm_id'   => $subFarm,
        //         'date'          => $request->date,
        //         'do'            => $request->do,
        //         'crate'         => $request->crate,
        //         'quantity'      => 0,
        //     ];
        //     Sales::create($nullData);
        // }
        $this->validate($request, [
            'supplier_id'   => ['required'],
            'farm_id'       => ['required'],
            'sub_farm_id'   => ['required'],
            'date'          => ['date'],
            'quantity'       => ['nullable'],
        ]);
        DB::beginTransaction();
        $tran = transaction_id();
        foreach ($request->sub_farm_id as $k => $v) {
            $data = [
                'user_id' => user()->id,
                'supplier_id' => $request->supplier_id,
                'farm_id' => $request->farm_id,
                'sub_farm_id' => $request->sub_farm_id[$k],
                'date' => $request->date,
                'do'            => $request->do,
                'crate'         => $request->crate,
                'quantity' => $request->quantity[$k],
                // 'tran' => $tran,
            ];
            Sales::create($data);
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
