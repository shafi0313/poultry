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
                                        {{-- <h3>{{ $dailyEntries->first()->farm->name ?? ''}}</h3>
                                    <h4>{{ bdDate(Carbon\Carbon::now()) }}</h4> --}}
                                    </div>
                                    <div class="table-responsive">
                                        <table id="multi-filter-select"
                                            class="display table table-striped table-hover text-center">
                                            <thead class="bg-secondary thw">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Sub Farm</th>
                                                    <th>Dead</th>
                                                    <th>Reject</th>
                                                    <th>Balance Chicken</th>
                                                    <th>Used Feed</th>
                                                    <th>Balance Feed</th>
                                                </tr>
                                            </thead>
                                            @php
                                                $x = 1;
                                                // $dead = $reject = $feed = 1;
                                            @endphp

                                            <tbody>

                                                @foreach ($purchases as $purchase)
                                                    {{-- ->whereBetween('date',[$start_date, $end_date]) --}}


                                                    @php
                                                        $dateTotal = $purchase->dailyEntries->where('sub_farm_id', $purchase->sub_farm_id)->where('date', '<=', [$start_date, $end_date]);
                                                        $previousTotal = $purchase->dailyEntries->where('sub_farm_id', $purchase->sub_farm_id)->where('date', '<=', $end_date);
                                                        $dead = $dateTotal->sum('dead');
                                                        $reject = $dateTotal->sum('reject');
                                                        $feed = $dateTotal->sum('feed');

                                                        $balanceFeed = $purchase->feed - $previousTotal->sum('feed');
                                                        $balanceChicken = $purchase->chicken - ($dead + $reject);

                                                    @endphp
                                                    <div style="display: none">
                                                        <input type="text" class="dead" value="{{ $dead }}">
                                                        <input type="text" class="reject" value="{{ $reject }}">
                                                        <input type="text" class="feed" value="{{ $feed }}">
                                                        <input type="text" class="balanceFeed"
                                                            value="{{ $balanceFeed }}">
                                                        <input type="text" class="balanceChicken"
                                                            value="{{ $balanceChicken }}">
                                                    </div>

                                                    <tr>
                                                        <td>{{ $x++ }}</td>
                                                        <td>{{ $purchase->subFarm->room_no }}</td>
                                                        <td>{{ $dateTotal->sum('dead') ?? 0 }}</td>
                                                        <td>{{ $dateTotal->sum('reject') ?? 0 }}</td>
                                                        <td>{{ $purchase->chicken - ($dead + $reject) }}</td>
                                                        <td>{{ $dateTotal->sum('feed') ?? 0 }}</td>
                                                        <td>{{ $balanceFeed }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            {{-- <tfoot> --}}
                                            <tr style="font-weight: bold" class="bg-success">
                                                <td></td>
                                                <td class="text-right">Total: </td>
                                                <td id="dead">{{ $dead }}</td>
                                                <td id="reject">{{ $reject }}</td>
                                                <td id="balanceChicken"></td>
                                                <td id="feed"></td>
                                                <td id="balanceFeed"></td>
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
            <script>
                $(document).ready(function() {
                    let dead = 0;
                    $('.dead').each(function() {
                        dead += parseFloat($(this).val());
                    });
                    $('#dead').text(dead)

                    let reject = 0;
                    $('.reject').each(function() {
                        reject += parseFloat($(this).val());
                    });
                    $('#reject').text(reject)

                    let feed = 0;
                    $('.feed').each(function() {
                        feed += parseFloat($(this).val());
                    });
                    $('#feed').text(feed)

                    let balanceFeed = 0;
                    $('.balanceFeed').each(function() {
                        balanceFeed += parseFloat($(this).val());
                    });
                    $('#balanceFeed').text(balanceFeed)

                    let balanceChicken = 0;
                    $('.balanceChicken').each(function() {
                        balanceChicken += parseFloat($(this).val());
                    });
                    $('#balanceChicken').text(balanceChicken)
                });
            </script>
        @endpush
    @endsection
