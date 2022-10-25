@extends('admin.layouts.app')
@section('title', 'Daily Entry Report')
@section('content')
<style>
    .dead {
        background: rgb(253, 128, 128)
    }
    .feed {
        background: rgb(96, 255, 130)
    }
    /* .date {
        background: rgb(223, 223, 223)
    } */
    .total {
        background: rgb(252, 255, 85)
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
                                                    <td rowspan="2">Date</td>
                                                    @foreach ($dailyEntries->groupBy('sub_farm_id') as $dailyEntri)
                                                        @php
                                                            $dailyEntrie = $dailyEntri->first();
                                                        @endphp
                                                        <th colspan="2">{{ $dailyEntrie->subFarm->room_no }}</th>
                                                    @endforeach
                                                    <td colspan="2">Total D/F</td>
                                                </tr>
                                                <tr>
                                                    @foreach ($dailyEntries->groupBy('sub_farm_id') as $dailyEntri)
                                                        <th class="dead">Dead</th>
                                                        <th class="feed">Feed</th>
                                                    @endforeach
                                                    <th class="dead">Dead</th>
                                                    <th class="feed">Feed</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($dailyEntries->groupBy('date') as $gByDate)
                                                @php
                                                    $fGByDate = $gByDate->first();
                                                @endphp
                                                    <tr>
                                                        <td class="date">{{ bdDate($fGByDate->date) }}</td>
                                                        @foreach ($gByDate->groupBy('sub_farm_id') as $dailyEntri)
                                                            @php
                                                                $dailyEntrie = $dailyEntri->first()->first();
                                                            @endphp
                                                            <td class="dead">{{ $dailyEntri->sum('dead') }}</td>
                                                            <td class="feed">{{ $dailyEntri->sum('feed') }}</td>
                                                        @endforeach
                                                        <td class="dead">{{ $gByDate->sum('dead') }}</td>
                                                        <td class="feed">{{ $gByDate->sum('feed') }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                            <tr style="font-weight: bold">
                                                <td class="total">Total</td>
                                                @foreach ($dailyEntries->groupBy('sub_farm_id') as $dailyEntri)
                                                    @php
                                                        $dailyEntrie = $dailyEntri->first();
                                                    @endphp
                                                    <td class="dead">{{ $dailyEntri->sum('dead') }}</td>
                                                    <td class="feed">{{ $dailyEntri->sum('feed') }}</td>
                                                @endforeach
                                                <td class="dead">{{ $dailyEntries->sum('dead') }}</td>
                                                <td class="feed">{{ $dailyEntries->sum('feed') }}</td>
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
            <script>
                // $(document).ready(function() {
                //     let dead = 0;
                //     $('.dead').each(function() {
                //         dead += parseFloat($(this).val());
                //     });
                //     $('#dead').text(dead)

                //     let reject = 0;
                //     $('.reject').each(function() {
                //         reject += parseFloat($(this).val());
                //     });
                //     $('#reject').text(reject)

                //     let feed = 0;
                //     $('.feed').each(function() {
                //         feed += parseFloat($(this).val());
                //     });
                //     $('#feed').text(feed)

                //     let balanceFeed = 0;
                //     $('.balanceFeed').each(function() {
                //         balanceFeed += parseFloat($(this).val());
                //     });
                //     $('#balanceFeed').text(balanceFeed)

                //     let balanceChicken = 0;
                //     $('.balanceChicken').each(function() {
                //         balanceChicken += parseFloat($(this).val());
                //     });
                //     $('#balanceChicken').text(balanceChicken)
                // });
            </script>
        @endpush
    @endsection
