@extends('admin.layouts.app')
@section('title', 'Daily Entry Report')
@section('content')

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
                            <div class="card-body row justify-content-center">
                                <div class="text-center">
                                    <h3>{{ $dailyEntries->first()->farm->name ?? ''}}</h3>
                                    <h4>{{ bdDate(Carbon\Carbon::now()) }}</h4>
                                </div>
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover text-center">
                                    <thead class="bg-secondary thw">
                                        <tr>
                                            <th>SL</th>
                                            <th>Room No</th>
                                            <th>Dead</th>
                                            <th>Reject</th>
                                            <th>Balance Chicken</th>
                                            <th>Used Feed</th>
                                            <th>Balance Feed</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $x = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($dailyEntries->whereBetween('date',[$start_date, $end_date]) as $dailyEntry)
                                        <tr>
                                            <td>{{ $x++ }}</td>
                                            <td>{{ $dailyEntry->subFarm->room_no }}</td>
                                            <td>{{ $dailyEntry->dead }}</td>
                                            <td>{{ $dailyEntry->reject }}</td>
                                            {{-- <td>{{ $dailyEntry->purchase->type == 'chicken' ? $dailyEntry->purchase->quantity - $dailyEntries->where('sub_farm_id',$dailyEntry->sub_farm_id)->where('date','<=',$end_date)->sum('dead') : 0 }}</td> --}}
                                            <td>{{ $dailyEntry->feed }}</td>
                                            <td>{{ $dailyEntry->purchase->feed - $dailyEntries->where('sub_farm_id',$dailyEntry->sub_farm_id)->where('date','<=',$end_date)->sum('feed') }}</td>
                                            @php
                                                $feedBalance = $dailyEntry->purchase->sum('feed') - $dailyEntries->where('date','<=',$end_date)->sum('feed');
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- <tfoot> --}}
                                        <tr style="font-weight: bold" class="bg-success">
                                            <td></td>
                                            <td class="text-right">Total: </td>
                                            <td>{{ $dailyEntries->whereBetween('date',[$start_date, $end_date])->sum('dead') }}</td>
                                            <td>{{ $dailyEntries->whereBetween('date',[$start_date, $end_date])->sum('reject') }}</td>
                                            <td>{{ $dailyEntries->whereBetween('date',[$start_date, $end_date])->sum('feed') }}</td>
                                            <td>{{ $feedBalance ?? ''}}</td>
                                        </tr>
                                    {{-- </tfoot> --}}
                                </table>
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

