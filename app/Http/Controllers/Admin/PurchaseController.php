<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\SubFarm;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Validation\Rule;
use App\Http\Requests\PurchaseStoreRequest;

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
        return view('admin.purchase.create', compact('suppliers', 'farms'));
    }

    public function getFarm(Request $request)
    {
        $inputs = SubFarm::whereFarm_id($request->farm_id)->get();
        $subFarms = view('admin.purchase.sub_farm', ['inputs' => $inputs])->render();
        return response()->json(['status' => 'success', 'html' => $subFarms, 'subFarms']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_id'   => ['required'],
            'farm_id'       => ['required'],
            'sub_farm_id'   => ['required'],
            'date'          => ['date'],
            'chicken'       => ['nullable'],
            'feed'          => ['nullable'],
        ]);
        DB::beginTransaction();
        $tran = transaction_id();
        foreach ($request->sub_farm_id as $k => $v) {
            $data = [
                'user_id' => user()->id,
                'type' => $request->type,
                'supplier_id' => $request->supplier_id,
                'farm_id' => $request->farm_id,
                'date' => $request->date,
                'sub_farm_id' => $request->sub_farm_id[$k],
                'chicken' => $request->chicken[$k],
                'feed' => $request->feed[$k],
                'tran' => $tran,
            ];
            Purchase::create($data);
        }
        try {
            DB::commit();
            Alert::success('Success', 'Data saved successfully');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            // Alert::error('Opps..', $e->getMessage());
            return $e->getMessage();
            // return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
