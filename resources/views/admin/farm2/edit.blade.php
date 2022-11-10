@extends('admin.layouts.app')
@section('title', 'Room No')
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('admin.farm.index') }}">Farm</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item">Edit</li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Room No</div>
                        </div>
                        <form action="{{ route('admin.sub-farm.update', $subFarm->id) }}" method="post">
                            @csrf @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Farm Name <span class="t_r">*</span></label>
                                            <select name="farm_id" class="form-control" required>
                                                @foreach ($farms as $farm)
                                                <option value="{{ $farm->id }}" @selected($farm->id==$subFarm->farm_id)>{{ $farm->name }}</option>
                                                @endforeach
                                                @if ($errors->has('farm_id'))
                                                    <div class="alert alert-danger">{{ $errors->first('farm_id') }}</div>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="room_no">Room No <span class="t_r">*</span></label>
                                            <input type="text" name="room_no" class="form-control" value="{{ $subFarm->room_no }}" required>
                                            @if ($errors->has('room_no'))
                                            <div class="alert alert-danger">{{ $errors->first('room_no') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $subFarm->name }}">
                                            @if ($errors->has('name'))
                                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
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
    @include('include.footer')
</div>

@push('custom_scripts')
@endpush
@endsection

