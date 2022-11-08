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
                            <form action="{{ route('admin.personal-sales.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Customer <span
                                                        class="t_r">*</span></label>
                                                <select class="form-control select2" name="customer_id" required>
                                                    <option selected value disabled>Select</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('customer_id'))
                                                    <div class="alert alert-danger">{{ $errors->first('customer_id') }}
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
                                                <label for="sub_farm_id">Room No <span class="t_r">*</span></label>
                                                <select class="form-control select2" name="sub_farm_id" id="subFarms" required>
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
                                                <label for="quantity">PCS <span class="t_r">*</span></label>
                                                <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}" required id="quantity">
                                                @if ($errors->has('quantity'))
                                                    <div class="alert alert-danger">{{ $errors->first('quantity') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="weight">T. Wt. <span class="t_r">*</span></label>
                                                <input type="number" class="form-control" name="weight" value="{{ old('weight') }}" required id="weight">
                                                @if ($errors->has('weight'))
                                                    <div class="alert alert-danger">{{ $errors->first('weight') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">T. Wt. <span class="t_r">*</span></label>
                                                <input type="number" class="form-control" name="" value="" readonly id="avg_weight">
                                                @if ($errors->has(''))
                                                    <div class="alert alert-danger">{{ $errors->first('') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">U Price <span class="t_r">*</span></label>
                                                <input type="number" class="form-control" name="price" value="{{ old('price') }}" id="price" required>
                                                @if ($errors->has('price'))
                                                    <div class="alert alert-danger">{{ $errors->first('price') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Amount <span class="t_r">*</span></label>
                                                <input type="number" class="form-control" name="" value="" readonly id="amount">
                                                @if ($errors->has(''))
                                                    <div class="alert alert-danger">{{ $errors->first('') }}</div>
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

            $("#quantity, #weight").keyup(function(){
                let quantity = $("#quantity").val();
                let weight = $("#weight").val();
                let avg = Number.parseFloat(weight/quantity).toFixed(3)
                $("#avg_weight").val(avg);
            })

            $("#price, #weight").keyup(function(){
                let price = $("#price").val();
                let weight = $("#weight").val();
                let amount = Number.parseFloat(price * weight).toFixed(2)
                $("#amount").val(amount);
            })
        </script>
    @endpush
@endsection
