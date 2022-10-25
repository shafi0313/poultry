@extends('admin.layouts.app')
@section('title', 'Chicken Sales')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item"><a href="{{ route('admin.sales.index') }}">Chicken Sales List</a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item">Create</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add Chicken Sales</div>
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
                                                <label for="exampleFormControlSelect1">Company <span
                                                        class="t_r">*</span></label>
                                                <select class="form-control select2" name="supplier_id" required>
                                                    <option selected value disabled>Select</option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('supplier_id'))
                                                    <div class="alert alert-danger">{{ $errors->first('supplier_id') }}
                                                    </div>
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
                                                <label for="sub_farm_id">Sub Farm <span class="t_r">*</span></label>
                                                <select class="form-control select2" name="sub_farm_id" id="sub_farm_id"
                                                    required>
                                                    <option selected value disabled>Select</option>
                                                </select>
                                                @if ($errors->has('sub_farm_id'))
                                                    <div class="alert alert-danger">{{ $errors->first('sub_farm_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Date <span class="t_r">*</span></label>
                                                <input type="date" class="form-control" name="date"
                                                    value="{{ old('date') }}" required>
                                                @if ($errors->has('date'))
                                                    <div class="alert alert-danger">{{ $errors->first('date') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="do">Delivery Order <span class="t_r">*</span></label>
                                                <input type="number" class="form-control" name="do"
                                                    value="{{ old('do') }}" required>
                                                @if ($errors->has('do'))
                                                    <div class="alert alert-danger">{{ $errors->first('do') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="crate">Total Crate <span class="t_r">*</span></label>
                                                <input type="text" class="form-control" name="crate"
                                                    value="{{ old('crate') }}" required>
                                                @if ($errors->has('crate'))
                                                    <div class="alert alert-danger">{{ $errors->first('crate') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="quantity">Quantity <span class="t_r">*</span></label>
                                                <input type="number" class="form-control" name="quantity"
                                                    value="{{ old('quantity') }}" required>
                                                @if ($errors->has('quantity'))
                                                    <div class="alert alert-danger">{{ $errors->first('quantity') }}</div>
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
                            $('#sub_farm_id').html(res.html);
                        }
                    }
                });
            });

            $("#submitForm").on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'post',
                    url: '{{ route('admin.sales.store') }}',
                    data: formData,
                    // processData: false,
                    // contentType: false,
                    success: res => {
                        $("[name='quantity']").val('');
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
