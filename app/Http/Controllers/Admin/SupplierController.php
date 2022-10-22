<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SupplierStoreRequest;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        // if ($error = $this->authorize('employee-manage')) {
        //     return $error;
        // }
        if ($request->ajax()) {
            $suppliers = Supplier::query();
            return DataTables::of($suppliers)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    return '<input type="checkbox" name="select[]" onclick="checkcheckbox()" id="check_'.$row->id.'" class="check" value="'.$row->id.'">';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.supplier.edit', $row->id) , 'row' => $row]);
                    $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.supplier.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    return $btn;
                })
                ->rawColumns(['check', 'age', 'action', 'created_at'])
                ->make(true);
        }
        return view('admin.supplier.index');
    }

    public function store(SupplierStoreRequest $request)
    {
        // if ($error = $this->authorize('employee-add')) {
        //     return $error;
        // }
        DB::beginTransaction();
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        Supplier::create($data);
        try {
            DB::commit();
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }


    public function edit(Request $request, Supplier $supplier)
    {
        // if ($error = $this->authorize('class-room-edit')) {
        //     return $error;
        // }
        if ($request->ajax()) {
            $modal = view('admin.supplier.edit')->with('supplier', $supplier)->render();
            return response()->json(['modal' => $modal], 200);
        }
        return abort(500);
    }


    public function update(SupplierStoreRequest $request, Supplier $supplier)
    {
        // if ($error = $this->authorize('class-room-edit')) {
        //     return $error;
        // }
        $data = $request->validated();
        try {
            $supplier->update($data);
            return response()->json(['message'=> 'Updated Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
        }
    }

    public function destroy(Supplier $supplier)
    {
        // if ($error = $this->authorize('class-room-delete')) {
        //     return $error;
        // }
        try {
            $supplier->delete();
            return response()->json(['message'=> 'Deleted Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}

