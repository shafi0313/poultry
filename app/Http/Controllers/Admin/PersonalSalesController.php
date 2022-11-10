<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\PersonalSalesStoreRequest;
use App\Models\PersonalSales;

class PersonalSalesController extends Controller
{
    public function index()
    {
        return view('admin.personal_sales.create');
    }

    public function create()
    {
        $customers = Customer::all(['id', 'name']);
        $farms = Farm::all(['id', 'name']);
        return view('admin.personal_sales.create', compact('customers', 'farms'));
    }

    public function store(Request $request, PersonalSalesStoreRequest $personalSales)
    {
        if($request->customer_id == 0){
            $customerData = $request->validate([
                'name' => 'required',
                'phone' => 'nullable',
                'address' => 'nullable',
            ]);
            $customerData = Customer::create($customerData);
            $salesData['customer_id'] = $customerData->id;
        }else{
            $salesData['customer_id'] = $request->customer_id;
        }
        $salesData = $personalSales->validated();
        $salesData['user_id'] = user()->id;

        try {
            PersonalSales::create($salesData);
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
