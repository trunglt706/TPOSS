<div class="mb-1">@lang('confirm_delete_admin')</div>
<input type="hidden" name="deleted_id" class="deleted_id" value="{{ $id }}">
<select name="assigned_id" class="select2 form-select assigned_id">
    @foreach ($admins as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
</select>
<div class="delete-error text-danger mt-1"></div>
<script>
    $('.select2').select2();
</script>
