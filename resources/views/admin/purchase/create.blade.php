@extends('admin.layouts.app')
@section('title', 'Purchase')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item"><a href="{{ route('admin.purchase.index') }}">Purchase List</a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item">Create</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add Purchase</div>
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
                            <form action="{{ route('admin.purchase.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Type <span
                                                        class="t_r">*</span></label>
                                                <select class="form-control select2" name="type" required>
                                                    <option selected value disabled>Select</option>
                                                    <option value="chicken">Chicken</option>
                                                    <option value="feed">Feed</option>
                                                </select>
                                                @if ($errors->has('type'))
                                                    <div class="alert alert-danger">{{ $errors->first('type') }}</div>
                                                @endif
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Supplier <span
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
                                                <label for="exampleFormControlSelect1">Farm <span
                                                        class="t_r">*</span></label>
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
                                        <div class="col-md-6 col-sm-12">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Room No</th>
                                                        <th>Name</th>
                                                        <th>Chicken</th>
                                                        <th>Feed</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="subFarms" id="subFarms"></tbody>
                                                <tfoot>
                                                    <td colspan="3" class="text-right">Total</td>
                                                    <td id="chickenTotal"></td>
                                                    <td id="feedTotal"></td>
                                                </tfoot>
                                            </table>
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
                    url: '{{ route('admin.purchase.getFarm') }}',
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
        </script>
    @endpush
@endsection
