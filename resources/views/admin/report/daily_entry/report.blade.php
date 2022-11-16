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
                                        <h3>{{ $dailyEntries->first()->farm->name ?? '' }}</h3>
                                        <h4>{{ bdDate($start_date) }}</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="multi-filter-select"
                                            class="display table table-striped table-hover text-center">
                                            <thead class="bg-secondary thw">
                                                <tr>
                                                    <th>Room No</th>
                                                    <th>Dead Chicken</th>
                                                    <th>Used Feed</th>
                                                    <th>Feed Remaining</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dailyEntries as $dailyEntry)
                                                    <tr>
                                                        <td>{{ $dailyEntry->subFarm->room_no }}</td>
                                                        <td>{{ $dailyEntry->dead }}</td>
                                                        <td>{{ $dailyEntry->feed }}</td>
                                                        <td>{{ $dailyEntry->balance_feed }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tr>
                                                <td>Total: </td>
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

        @push('custom_scripts')
            <!-- Datatables -->
            @include('include.data_table')
        @endpush
    @endsection
