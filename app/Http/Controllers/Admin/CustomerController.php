<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // if ($error = $this->authorize('employee-cat-manage')) {
        //     return $error;
        // }
        if ($request->ajax()) {
            $customers = Customer::query();
            return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    return '<input type="checkbox" name="select[]" onclick="checkcheckbox()" id="check_'.$row->id.'" class="check" value="'.$row->id.'">';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.customer.edit', $row->id) , 'row' => $row]);
                    $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.customer.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    return $btn;
                })
                ->rawColumns(['check', 'action', 'created_at'])
                ->make(true);
        }
        return view('admin.customer.index');
    }


    public function store(Request $request)
    {
        // if ($error = $this->authorize('employee-cat-add')) {
        //     return $error;
        // }
        $data = $request->validate([
            'name' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        try {
            Customer::create($data);
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function edit(Request $request, Customer $customer)
    {
        if ($error = $this->authorize('employee-cat-edit')) {
            return $error;
        }
        if ($request->ajax()) {
            $modal = view('admin.customer.edit')->with('employeeCat', $customer)->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }

    public function update(Request $request, Customer $customer)
    {
        if ($error = $this->authorize('employee-cat-edit')) {
            return $error;
        }
        $data = $request->validate([
            'name' => 'required|unique:employee_cats,name',
        ]);

        try {
            $customer->update($data);
            return response()->json(['message'=> 'Data Successfully Updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
        }
    }

    public function destroy(Customer $customer)
    {
        if ($error = $this->authorize('employee-cat-delete')) {
            return $error;
        }
        try {
            $customer->delete();
            return response()->json(['message'=> 'Data Successfully Deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
