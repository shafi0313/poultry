<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Supplier Update</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.supplier.update', $supplier->id) }}" method="post" onsubmit="ajaxStore(event, this, 'POST', 'editModal')" class="form-horizontal">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">Name <span class="t_r">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" required>
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $supplier->email }}">
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="phone">Phone <span class="t_r">*</span></label>
                        <input type="text" name="phone" class="form-control" value="{{ $supplier->phone }}">
                        @if ($errors->has('phone'))
                            <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="address">Address <span class="t_r">*</span></label>
                        <input type="text" name="address" class="form-control" value="{{ $supplier->address }}" required>
                        @if ($errors->has('address'))
                            <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                        @endif
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
        </form>
      </div>
    </div>
  </div>

