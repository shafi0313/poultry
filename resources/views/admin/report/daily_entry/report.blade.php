@extends('admin.layouts.app')
@section('title', 'Daily Entry Report')
@section('content')
<style>
    body {
        color: black !important;
        font-weight: bold;
    }
    h4 {
        font-weight: bold;
        font-size: 15px;
    }
    table {
        border-collapse: collapse;
        margin-bottom: 0 !important;
    }
    .table td, .table th {
        border-left: 1px solid black !important;
        border-right: 1px solid black !important;
    }
    th:last-child, td:last-child {
        border-right :none !important;
    }
    th:first-child, td:first-child {
        border-left :none !important;
    }
</style>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item">Daily Entry Report</li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title"></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-body row justify-content-center" style="width: 397px;">
                                    <div style="border: 1px solid black">
                                        <div class="text-center" style="background: #FED966; width: 100%; display: flex; justify-content: space-between; padding: 15px 8px 8px 8px">
                                            <h4>{{ $dailyEntries->first()->farm->name ?? '' }}</h4>
                                            <h4>Date: {{ bdDate($start_date) }}</h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="display table  table-hover text-center">
                                                <thead class="">
                                                    <tr style="background: #8DABDF">
                                                        <th width="95px">Room No</th>
                                                        <th width="95px">Dead</th>
                                                        <th width="95px">Used</th>
                                                        <th width="95px">Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dailyEntries as $dailyEntry)
                                                        <tr>
                                                            <td>{{ $dailyEntry->subFarm->room_no }}</td>
                                                            <td style="color: red">{{ $dailyEntry->dead }}</td>
                                                            <td>{{ $dailyEntry->feed }}</td>
                                                            <td>{{ $dailyEntry->balance_feed }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tr style="background: #FFE2D8;">
                                                    <td>Total</td>
                                                    <td>{{ $dailyEntries->sum('dead') }}</td>
                                                    <td>{{ $dailyEntries->sum('feed') }}</td>
                                                    <td>{{ $dailyEntries->sum('balance_feed') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
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
