@extends('admin.layouts.app')
@section('title', 'Chicken Sales Report')
@section('content')
    <style>
        /* .dead {
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
        } */
    </style>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item">Chicken Sales Report</li>
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
                                        <h3>{{ $sales->first()->farm->name ?? '' }}</h3>
                                        <h4>Form: {{ bdDate($start_date) }} to: {{ bdDate($end_date) }}</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="multi-filter-select"
                                            class="display table table-striped table-hover text-center">
                                            <thead class="bg-secondary thw">
                                                <tr>
                                                    <td>Date</td>
                                                    <td>D.O.</td>
                                                    <td>Total Crate</td>
                                                    @foreach ($sales->groupBy('sub_farm_id') as $gRoomNo)
                                                        @php
                                                            $roomNo = $gRoomNo->first();
                                                        @endphp
                                                        <th>{{ $roomNo->subFarm->room_no }}</th>
                                                    @endforeach
                                                    <td>Total D/F</td>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($sales->groupBy('do') as $gByDo)
                                                    @php
                                                        $fgByDo = $gByDo->first();
                                                    @endphp
                                                    <tr>
                                                        <td class="date">{{ bdDate($fgByDo->date) }}</td>
                                                        <td class="dead">{{ $fgByDo->do }}</td>
                                                        <td class="dead">{{ $fgByDo->crate }}</td>
                                                        @foreach ($gByDo->groupBy('sub_farm_id') as $quantity)
                                                            <td class="dead">{{ $quantity->sum('quantity') }}</td>
                                                        @endforeach
                                                        <td class="dead">{{ $gByDo->sum('quantity') }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                            <tr style="font-weight: bold">
                                                <td colspan="3" class="total">Total</td>
                                                @foreach ($sales->groupBy('sub_farm_id') as $sale)
                                                    <td class="dead">{{ $sale->sum('quantity') }}</td>
                                                @endforeach
                                                <td class="dead">{{ $sales->sum('quantity') }}</td>
                                            </tr>
                                            <tr style="font-weight: bold">
                                                <td colspan="3" class="total">Dead</td>
                                                @foreach ($dailyEntries->groupBy('sub_farm_id') as $dailyEntry)
                                                    <td class="dead">{{ $dailyEntry->sum('dead') }}</td>
                                                @endforeach
                                                <td class="dead">{{ $dailyEntries->sum('dead') }}</td>
                                            </tr>
                                            <tr style="font-weight: bold">
                                                <td colspan="3" class="total">Adjust</td>
                                                @foreach ($dailyEntries->groupBy('sub_farm_id') as $dailyEntry)
                                                    <td class="dead">{{ $dailyEntry->sum('dead') }}</td>
                                                @endforeach
                                                <td class="dead">{{ $dailyEntries->sum('dead') }}</td>
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
