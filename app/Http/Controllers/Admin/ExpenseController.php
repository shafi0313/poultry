<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseStoreRequest;
use App\Models\ExpenseCat;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with(['expenseCat','farm','subFarm'])->get();
        return view('admin.expense.index', compact('expenses'));
    }
    public function create()
    {
        $expenseCats = ExpenseCat::all();
        $farms = Farm::all(['id', 'name']);
        return view('admin.expense.create', compact('expenseCats','farms'));
    }
    public function store(ExpenseStoreRequest $expense)
    {
        // if ($error = $this->authorize('employee-cat-add')) {
        //     return $error;
        // }
        $data = $expense->validated();
        $data['user_id'] = user()->id;

        try {
            Expense::create($data);
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
