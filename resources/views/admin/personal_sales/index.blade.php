@extends('admin.layouts.app')
@section('title', 'Farms & Room Nos')
@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item">Farms & Room Nos</li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add Row</h4>
                                <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#farmModal">
                                    Add Farm
                                  </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                    <thead class="bg-secondary thw">
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Created at</th>
                                            <th class="no-sort" width="40px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x = 1 @endphp
                                        @foreach ($farms as $farm)
                                        <tr class="bg-primary text-light">
                                            <td >{{ $x++ }}</td>
                                            <td>{{ $farm->name }}</td>
                                            <td>{{ $farm->phone }}</td>
                                            <td>{{ $farm->address }}</td>
                                            <td>{{ bdDate($farm->created_at) }}</td>
                                            <td class="text-right">
                                                <div class="form-button-action">
                                                    <span class="btn btn-danger btn-sm addSubFarm" data-toggle="modal" data-target="#addSubFarm" data-id="{{$farm->id}}" data-farm-name="{{ $farm->name }}">Add Room No</span>
                                                    <span class="btn btn-info btn-sm editFarm" data-toggle="modal" data-target="#editFarm" data-url="{{route('admin.farm.update', $farm->id)}}" data-name="{{$farm->name}}"><i class="fa fa-edit"></i></span>
                                                    {{-- <form action="" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                        </tr>
                                        @if ($farm->subFarms->count() > 0)
                                        <thead class="bg-success thw">
                                            <tr>
                                                <th></th>
                                                <th class="text-center">SL</th>
                                                <th class="text-center">Room No</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Created at</th>
                                                <th class="no-sort" width="40px">Action</th>
                                            </tr>
                                        </thead>
                                        @php $xx = 1 @endphp
                                        @foreach ($farm->subFarms as $subFarm)
                                        <tr class="text-center">
                                            <td></td>
                                            <td class="text-center">{{ $xx++ }}</td>
                                            <td>{{ $subFarm->room_no }}</td>
                                            <td>{{ $subFarm->name }}</td>
                                            <td>{{ bdDate($subFarm->created_at) }}</td>
                                            <td class="text-right">
                                                <div class="form-button-action">
                                                    <a href="{{route('admin.sub-farm.edit', $subFarm->id)}}" title="Edit" class="btn btn-link btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{-- <span class="btn btn-info btn-sm editSubFarm" data-toggle="modal" data-target="#editSubFarm" data-url="{{route('admin.sub-farm.update', $subFarm->id)}}" data-room_no="{{$subFarm->room_no}}" data-name="{{$subFarm->name}}"><i class="fa fa-edit"></i></span> --}}
                                                    <form action="{{ route('admin.sub-farm.destroy', $subFarm->id) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
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


<!-- Add Farm-->
<div class="modal fade" id="farmModal" tabindex="-1" role="dialog" aria-labelledby="farmModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="farmModalLabel">Add Farm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('admin.farm.store') }}" method="post">
          @csrf
            <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="user_id">In charge<span class="t_r">*</span></label>
                          <select name="user_id" id="" class="form-control select">
                            <option value="">Select</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('user_id'))
                          <div class="alert alert-danger">{{ $errors->first('user_id') }}</div>
                          @endif
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="name">Farm Name<span class="t_r">*</span></label>
                          <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                          @if ($errors->has('name'))
                          <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                          @endif
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="phone">Phone<span class="t_r">*</span></label>
                          <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                          @if ($errors->has('phone'))
                          <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                          @endif
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="address">Address<span class="t_r">*</span></label>
                          <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                          @if ($errors->has('address'))
                          <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                          @endif
                      </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
</div>

<!-- Edit Farm -->
<div class="modal fade" id="editFarm" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <form action="" method="POST" autocomplete="off" id="subjectEditForm">
      @csrf
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editLabel" style="color:red;">Edit Farm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="name">Farm Name <span class="t_r">*</span></label>
                          <input type="text" name="name" class="form-control" id="editName" required>
                          @if ($errors->has('name'))
                          <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success btn-sm">Update</button>
          </div>
      </div>
  </form>
</div>
</div>



@include('admin.farm.sub_farm_modal')

<!-- Option Edit -->
{{-- <div class="modal fade" id="editSubFarm" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <form action="" method="POST" autocomplete="off" id="editSubFarmForm">
      @csrf @method('PUT')
       <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editLabel" style="color:red;">Edit Room No</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="room_no">Room No <span class="t_r">*</span></label>
                        <input type="text" name="room_no" class="form-control" id="editSubFarmRoomNo" required>
                        @if ($errors->has('room_no'))
                        <div class="alert alert-danger">{{ $errors->first('room_no') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="editSubFarmName">
                        @if ($errors->has('name'))
                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success btn-sm">Update</button>
          </div>
      </div>
  </form>
</div>
</div> --}}

@push('custom_scripts')
    <!-- Datatables -->
    @include('include.data_table')
    <script>
        $(".editFarm").on('click', function(){
            $('#subjectEditForm').attr('action',$(this).data('url'));
            $('#editName').val($(this).data('name'));
        });

        $(".addSubFarm").on('click', function(){
            $('#farm_id').val($(this).data('id'));
            $('#farmName').val($(this).data('farm-name'));
        });

        // $(".editSubFarm").on('click', function(){
        //     $('#editSubFarmForm').attr('action',$(this).data('url'));
        //     $('#editSubFarmRoomNo').val($(this).data('room_no'));
        //     $('#editSubFarmName').val($(this).data('name'));
        // });

    </script>

@endpush
@endsection

