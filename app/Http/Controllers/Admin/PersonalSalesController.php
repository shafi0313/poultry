<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
