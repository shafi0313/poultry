@extends('admin.layouts.app')
@section('title', 'Daily Entry')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item"><a href="{{ route('admin.purchase.index') }}">Daily Entry List</a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item">Create</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add Daily Entry</div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form id="submitForm">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Date <span class="t_r">*</span></label>
                                                <input type="date" name="date" class="form-control" required>
                                                @if ($errors->has('date'))
                                                    <div class="alert alert-danger">{{ $errors->first('date') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
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

                                        <div class="col-sm-12">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Room No</th>
                                                        <th>Name</th>
                                                        <th>Dead Chicken</th>
                                                        <th>Used Feed</th>
                                                        <th>Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="subFarms" id="subFarms"></tbody>
                                                <tfoot>
                                                    <td colspan="2" class="text-right">Total</td>
                                                    <td id="chickenTotal"></td>
                                                    <td id="feedTotal"></td>
                                                    <td id="balanceFeedTotal"></td>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center card-action">
                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('custom_scripts')
        <script>
             $('#farm_id').change(function() {
                $.ajax({
                    url: '{{ route('admin.dailyEntryMulti.getFarm') }}',
                    method: 'get',
                    data: {
                        farm_id: $(this).val(),
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#subFarms').html(res.html);
                        }
                    }
                });
            })

            $("#submitForm").on('submit', function(e){
                e.preventDefault();
                var formdata = $(this).serialize();
                $.ajax({
                    type: 'post',
                    url: '{{ route('admin.daily-entry-multi.store') }}',
                    data: formdata,
                    success: res => {
                        $("#feedTotal").html('');
                        $("#balanceFeedTotal").html('');
                        $("#chickenTotal").html('');
                        $('form').trigger("reset");
                        swal({
                            icon: 'success',
                            title: 'Success',
                            text: res.message
                        }).then((confirm) => {
                            // if (confirm) {
                            //     $('.table').DataTable().ajax.reload();
                            //     $("#" + modal).modal('hide');
                            //     $(form).trigger("reset");
                            // }
                        });
                    },
                    error: err => {
                        swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: err.responseJSON.message
                        });
                    }
                });
            });
            // }
        </script>
    @endpush
@endsection
