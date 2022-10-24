<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.sub-farm.store') }}" method="post"
                onsubmit="ajaxStore(event, this, 'post', 'addModal')">
                @csrf
                <input type="hidden" name="farm_id" value="{{ $farm->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div style="margin: auto">
                            <button type="submit" class="btn btn-primary">Add</button>
                            ||
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </form>
        </div>
    </div>
</div>
