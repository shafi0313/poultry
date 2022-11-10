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

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Select Information</h4>
                                    {{-- <a data-toggle="modal" data-target="#employee_cat-add"
                                        class="btn btn-primary btn-round ml-auto text-light" style="min-width: 200px">
                                        <i class="fa fa-plus"></i> Add New
                                    </a> --}}
                                </div>
                            </div>
                            <form action="{{ route('admin.report.sales.report') }}" method="get">
                                {{-- @csrf --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="farm_id">Farm <span class="t_r">*</span></label>
                                                <select class="form-control select2" name="farm_id" id="farm_id" required>
                                                    <option selected value disabled>Select</option>
                                                    @foreach ($farms as $farm)
                                                        <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('farm_id'))
                                                    <div class="alert alert-danger">{{ $errors->first('farm_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sub_farm_id">Room No <span class="t_r">*</span></label>
                                                <select class="form-control select2" name="sub_farm_id" id="sub_farm_id"
                                                    required>
                                                    <option selected value disabled>Select</option>
                                                </select>
                                                @if ($errors->has('sub_farm_id'))
                                                    <div class="alert alert-danger">{{ $errors->first('sub_farm_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div> --}}

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_date">Start Date <span class="t_r">*</span></label>
                                                <input type="date" class="form-control" name="start_date">
                                                @if ($errors->has('start_date'))
                                                    <div class="alert alert-danger">{{ $errors->first('start_date') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date">End Date <span class="t_r">*</span></label>
                                                <input type="date" class="form-control" name="end_date">
                                                @if ($errors->has('end_date'))
                                                    <div class="alert alert-danger">{{ $errors->first('end_date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @push('custom_scripts')
            <!-- Datatables -->
            @include('include.data_table')
            <script>
                $('#farm_id').change(function() {
                $.ajax({
                    url: '{{ route('admin.global.getFarm') }}',
                    method: 'get',
                    data: {
                        farm_id: $(this).val(),
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#sub_farm_id').html(res.html);
                        }
                    }
                });
            });
            </script>
        @endpush
    @endsection
