@extends('admin.layouts.app')
@section('title', 'Personal Sales Report')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item">Personal Sales Report</li>
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
                                        <h3>{{ $reports->first()->farm->name ?? ''}}</h3>
                                        <h3>{{ $reports->first()->subFarm->room_no ?? ''}}</h3>
                                        <h4>Form: {{ bdDate($start_date) }} to: {{ bdDate($end_date) }}</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="multi-filter-select"
                                            class="display table table-striped table-hover text-center">
                                            <thead class="bg-secondary thw">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Date</th>
                                                    <th>Age</th>
                                                    <th>Name</th>
                                                    <th>Phn. No.</th>
                                                    <th>Pcs</th>
                                                    <th>Av.Wt.</th>
                                                    <th>T.Wt.</th>
                                                    <th>U Price</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php $x = 1; @endphp
                                                @foreach ($reports as $report)
                                                <tr>
                                                    <td>{{ $x++ }}</td>
                                                    <td>{{ bdDate($report->date) }}</td>
                                                    <td>{{ $report->age }}</td>
                                                    <td>{{ $report->customer->name }}</td>
                                                    <td>{{ $report->customer->phone }}</td>
                                                    <td>{{ $report->quantity }}</td>
                                                    <td>{{ number_format($report->weight / $report->quantity,3) }}</td>
                                                    <td>{{ $report->weight }}</td>
                                                    <td>{{ $report->price }}</td>
                                                    <td>{{ $report->price * $report->weight }}</td>
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
