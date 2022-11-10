@extends('admin.layouts.app')
@section('title', 'Expense List')
@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item">Expense List</li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add Row</h4>
                                <a href="{{ route('admin.expense.create') }}" class="btn btn-primary ml-auto">
                                    Add Expense
                                  </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                    <thead class="bg-secondary thw">
                                        <tr>
                                            <th>SL</th>
                                            <th>Expense</th>
                                            <th>Farm</th>
                                            <th>Room No</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th class="no-sort" width="40px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x = 1 @endphp
                                        @foreach ($expenses as $expense)
                                        <tr>
                                            <td >{{ $x++ }}</td>
                                            <td>{{ $expense->expenseCat->name }}</td>
                                            <td>{{ $expense->farm->name }}</td>
                                            <td>{{ $expense->subFarm->room_no ?? ''}}</td>
                                            <td>{{ bdDate($expense->date) }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            <td class="text-right">
                                                <div class="form-button-action">
                                                    <a href="{{route('admin.daily-entry.edit', $expense->id)}}" title="Edit" class="btn btn-link btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form>
                                                        @csrf @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('custom_scripts')
    <!-- Datatables -->
    @include('include.data_table')
@endpush
@endsection

