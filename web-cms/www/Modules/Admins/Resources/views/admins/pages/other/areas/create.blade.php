<div class="modal fade text-start modal-primary modalCreate" id="modalCreate" aria-labelledby="modalCreate"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form form-create" method="post" action="{{ route('admin.admin_groups.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-uppercase">@lang('create_new_data')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label" for="create-name">@lang('name') *</label>
                                <input type="text" id="create-name" class="form-control" name="name" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label for="description">@lang('description')</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        @lang('btn_create')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
