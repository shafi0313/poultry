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
                                    <h3>{{ $dailyEntries->first()->farm->name }}</h3>
                                    <h4>{{ bdDate(Carbon\Carbon::now()) }}</h4>
                                </div>
                            <div class="table-responsive">
                                <table id="DT" class="table table-striped table-hover">
                                    <thead class="bg-secondary thw">
                                        <tr>
                                            <th>SL</th>
                                            <th>Sub Farm</th>
                                            <th>Dead</th>
                                            <th>Reject</th>
                                            <th>Used Feed</th>
                                            <th>Balanced Feed</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $x = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($dailyEntries->where('date',Carbon\Carbon::now()->format('Y-m-d')) as $dailyEntry)
                                        <tr>
                                            <td>{{ $x++ }}</td>
                                            <td>{{ $dailyEntry->subFarm->room_no }}</td>
                                            <td>{{ $dailyEntry->dead }}</td>
                                            <td>{{ $dailyEntry->reject }}</td>
                                            <td>{{ $dailyEntry->feed }}</td>
                                            <td>{{ $dailyEntry->purchase->type == 'feed' ? $dailyEntry->purchase->quantity - $dailyEntries->where('sub_farm_id',$dailyEntry->sub_farm_id)->where('date','<=',Carbon\Carbon::now()->format('Y-m-d'))->sum('feed') : 0 }}</td>
                                            @php
                                                $feedBalance = $dailyEntry->purchase->type == 'feed' ? $dailyEntry->purchase->sum('quantity') - $dailyEntries->where('date','<=',Carbon\Carbon::now()->format('Y-m-d'))->sum('feed') : 0 ;
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="font-weight: bold">
                                            <td></td>
                                            <td class="text-right">Total: </td>
                                            <td>{{ $dailyEntries->where('date',Carbon\Carbon::now()->format('Y-m-d'))->sum('dead') }}</td>
                                            <td>{{ $dailyEntries->where('date',Carbon\Carbon::now()->format('Y-m-d'))->sum('reject') }}</td>
                                            <td>{{ $dailyEntries->where('date',Carbon\Carbon::now()->format('Y-m-d'))->sum('feed') }}</td>
                                            <td>{{ $feedBalance }}</td>
                                        </tr>
                                    </tfoot>
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

