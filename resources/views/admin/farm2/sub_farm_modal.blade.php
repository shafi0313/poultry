<!-- Add Chapter -->
<div class="modal fade" id="addSubFarm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Sub Farm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.sub-farm.store') }}" method="post">
              @csrf
              <input type="hidden" id="farm_id" name="farm_id">
                <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="name">Farm Name <span class="t_r">*</span></label>
                              <input type="text"  class="form-control" id="farmName" readonly>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="room_no">Room No <span class="t_r">*</span></label>
                              <input type="text" name="room_no" class="form-control" value="{{ old('room_no') }}"
                                  placeholder="Enter room no" required>
                              @if ($errors->has('room_no'))
                              <div class="alert alert-danger">{{ $errors->first('room_no') }}</div>
                              @endif
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                  placeholder="Enter name" >
                              @if ($errors->has('name'))
                              <div class="alert alert-danger">{{ $errors->first('name') }}</div>
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
