@extends('admin.layouts.app')
@section('title', 'Expense Category')
@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item">Expense Category</li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add Row</h4>
                                <a data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-round ml-auto text-light" style="min-width: 200px">
                                    <i class="fa fa-plus"></i> Add New
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body row justify-content-center">
                                @can('user-delete')
                                <div class="col-lg-12 mb-1">
                                    <button type="button" class="btn btn-warning mr-2" onclick="ajaxAllDelete(this, 'dt')"
                                        data-route="{{ route('admin.delete_all', 'ExpenseCat') }}" data-bs-placement="top" data-bs-toggle="tooltip"  data-bs-original-title="@lang('app.soft-delete-alert')" title="@lang('app.soft-delete-alert')">
                                        <i class="fa-solid fa-trash-arrow-up"> </i> @lang('app.delete')
                                    </button>
                                    <button data-route="{{ route('admin.force_delete_all', 'ExpenseCat') }}"
                                        onclick="ajaxAllDelete(this, 'dt')" class='btn btn-danger' data-bs-placement="top" data-bs-toggle="tooltip"  data-bs-original-title="@lang('app.force-delete-alert')" title="@lang('app.force-delete-alert')">
                                        <i class="fa-solid fa-trash"> </i>@lang("app.permanent-delete")
                                    </button>
                                </div>
                                @endcan

                            <div class="table-responsive">
                                <table id="DT" class="table table-striped table-hover">
                                    <thead class="bg-secondary thw">
                                        <tr>
                                            <td style="width:40px">
                                                <input type="checkbox" id="checkAll"> ID
                                            </td>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.expense_cat.create')

@push('custom_scripts')
    <!-- Datatables -->
    @include('include.data_table')
    <script>
        $(function() {
                    $('#DT').DataTable({
                        processing: true,
                        serverSide: true,
                        deferRender: true,
                        ordering: true,
                        responsive: true,
                        scrollY: 400,
                        ajax: "{{ route('admin.expense-cat.index') }}",
                        columns: [
                            {
                                data: 'check',
                                name: 'check',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                searchable: false,
                                orderable: false,
                            },
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ],
                        scroller: {
                            loadingIndicator: true
                        }
                    });
                });
    </script>
@endpush
@endsection

