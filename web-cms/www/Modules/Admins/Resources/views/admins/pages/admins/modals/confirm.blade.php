<div class="modal fade text-start modal-danger modalDelete" id="modalDelete" aria-labelledby="modalDelete"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">@lang('delete_data')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">@lang('confirm_delete_data')</div>
                <input type="hidden" name="deleted_id" class="deleted_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-submit-delete">
                    <i class="fa-solid fa-check"></i> @lang('confirm')
                </button>
            </div>
        </div>
    </div>
</div>
