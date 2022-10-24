<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">farm Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.farm.update', $farm->id) }}" method="post"
                onsubmit="ajaxStore(event, this, 'POST', 'editModal')" class="form-horizontal">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="user_id">In charge<span class="t_r">*</span></label>
                            <select name="user_id" id="" class="form-control select">
                                <option value="">Select</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @selected($user->id == $farm->user_id)>{{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_id'))
                                <div class="alert alert-danger">{{ $errors->first('user_id') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="name">Name <span class="t_r">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $farm->name }}"
                                required>
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="phone">Phone <span class="t_r">*</span></label>
                            <input type="text" name="phone" class="form-control" value="{{ $farm->phone }}">
                            @if ($errors->has('phone'))
                                <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="address">Address <span class="t_r">*</span></label>
                            <input type="text" name="address" class="form-control" value="{{ $farm->address }}"
                                required>
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
