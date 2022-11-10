@extends('admin.layouts.app')
@section('title', 'Personal Sales')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item"><a href="{{ route('admin.personal-sales.index') }}">Personal Sales List</a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item">Create</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add Personal Sales</div>
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
                                                <label for="expense_cat_id">Expense <span class="t_r">*</span></label>
                                                <select class="form-control select2" name="expense_cat_id" id="expense_cat_id" required>
                                                    <option selected value disabled>Select</option>
                                                    @foreach ($expenseCats as $expenseCat)
                                                        <option value="{{ $expenseCat->id }}">{{ $expenseCat->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('expense_cat_id'))
                                                    <div class="alert alert-danger">{{ $errors->first('expense_cat_id') }}</div>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sub_farm_id">Room No</label>
                                                <select class="form-control select2" name="sub_farm_id" id="subFarms">
                                                    <option selected value disabled>Select</option>
                                                </select>
                                                @if ($errors->has('sub_farm_id'))
                                                    <div class="alert alert-danger">{{ $errors->first('sub_farm_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Date <span class="t_r">*</span></label>
                                                <input type="date" class="form-control" name="date"
                                                    value="{{ old('date') }}" placeholder="Enter date" required>
                                                @if ($errors->has('date'))
                                                    <div class="alert alert-danger">{{ $errors->first('date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="amount">Amount <span class="t_r">*</span></label>
                                                <input type="number" class="form-control" name="amount" value="{{ old('amount') }}" required id="amount">
                                                @if ($errors->has('amount'))
                                                    <div class="alert alert-danger">{{ $errors->first('amount') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center card-action">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                    url: '{{ route('admin.global.getFarm') }}',
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
                var formData = $(this).serialize();
                $.ajax({
                    type: 'post',
                    url: '{{ route('admin.expense.store') }}',
                    data: formData,
                    // processData: false,
                    // contentType: false,
                    success: res => {
                        $("#amount").val('');
                        swal({
                            icon: 'success',
                            title: 'Success',
                            text: res.message
                        }).then((confirm) => {
                            // if (confirm) {
                                // $('.table').DataTable().ajax.reload();
                                // $("#" + modal).modal('hide');
                                // $(form).trigger("reset");
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
        </script>
    @endpush
@endsection
