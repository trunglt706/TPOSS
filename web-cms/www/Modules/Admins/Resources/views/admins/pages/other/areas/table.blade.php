@php
    use Modules\Admins\Entities\Area;
@endphp
<table class="table position-relative table-responsive">
    <thead>
        <tr>
            <th scope="col" class="text-nowrap">@lang('action')</th>
            <th scope="col" class="text-nowrap">@lang('name')</th>
            <th scope="col" class="text-nowrap">@lang('total_customer')</th>
            <th scope="col" class="text-nowrap">@lang('description')</th>
            <th scope="col" class="text-nowrap">@lang('status')</th>
            <th scope="col" class="text-nowrap">@lang('created_at')</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->count() > 0)
            @foreach ($data as $item)
                @php
                    $status = Area::get_status($item->status);
                @endphp
                <tr id="tr-{{ $item->id }}">
                    <td scope="col" class="text-nowrap">
                        <a href="{{ route('admin.admin_areas.detail', ['id' => $item->id]) }}"
                            class="btn btn-sm btn-icon btn-outline-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        @if (admin_menu_check_role('admin_areas|delete'))
                            <button onclick="deleteData('{{ $item->id }}')" type="button"
                                class="btn btn-sm btn-icon btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        @endif
                    </td>
                    <td scope="col" class="text-nowrap">
                        {{ $item->name }}
                    </td>
                    <td scope="col" class="text-nowrap">{{ number_format($item->customers_count) }}</td>
                    <td scope="col" class="text-nowrap">{{ $item->description }}</td>
                    <td scope="col" class="text-nowrap">
                        <span class="badge rounded-pill me-1 text-light"
                            style="background: {{ $status[1] }}">{{ $status[0] }}</span>
                    </td>
                    <td scope="col" class="text-nowrap">
                        {{ $item->created_at ? date('H:i:s d/m/Y', strtotime($item->created_at)) : '' }}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">
                    <i class="fa-solid fa-filter-circle-xmark text-secondary"></i>
                    <div class="text-secondary">@lang('not_found_data')</div>
                </td>
            </tr>
        @endif
    </tbody>
</table>
<div class="mt-2">
    {{ $data->appends(request()->all())->links() }}
</div>
