@php
    use Modules\Admins\Entities\Admins;
@endphp
<table class="table position-relative table-responsive">
    <thead>
        <tr>
            <th scope="col" class="text-nowrap">@lang('action')</th>
            <th scope="col" class="text-nowrap">@lang('name')</th>
            <th scope="col" class="text-nowrap">@lang('phone')</th>
            <th scope="col" class="text-nowrap">@lang('email')</th>
            <th scope="col" class="text-nowrap">@lang('status')</th>
            <th scope="col" class="text-nowrap">@lang('last_login')</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->count() > 0)
            @foreach ($data as $item)
                @php
                    $status = Admins::get_status($item->status);
                @endphp
                <tr id="tr-{{ $item->id }}">
                    <td scope="col" class="text-nowrap">
                        @if (admin_menu_check_role('admins|edit'))
                            <a href="{{ route('admin.admins.detail', ['id' => $item->id]) }}"
                                class="btn btn-icon btn-outline-primary">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                        @endif
                        @if (admin_menu_check_role('admins|delete') &&
                                $item->id !=
                                    auth()->guard('admin')->user()->id &&
                                !$item->root)
                            <button onclick="deleteAdmin('{{ $item->id }}')" type="button"
                                class="btn btn-icon btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        @endif
                    </td>
                    <td scope="col" class="text-nowrap d-flex">
                        <a href="{{ route('admin.admins.detail', ['id' => $item->id]) }}" data-bs-toggle="tooltip"
                            data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up my-0"
                            title="{{ $item->name }}">
                            <img src="{{ get_avatar($item->avatar, $item->name) }}" alt="{{ $item->name }}"
                                height="40" width="40" />
                        </a>
                        <div class="ms-1">
                            <span class="fw-bold {{ $item->root ? 'text-danger' : '' }}">
                                {{ $item->name }}<br />
                                {{ $item->code }} @if ($item->supper)
                                    <i class="fa-solid fa-check-double ms-1 text-success"></i>
                                @endif
                            </span>
                        </div>
                    </td>
                    <td scope="col" class="text-nowrap">{{ $item->phone }}</td>
                    <td scope="col" class="text-nowrap">{{ $item->email }}</td>
                    <td scope="col" class="text-nowrap">
                        <span class="badge rounded-pill me-1 text-light"
                            style="background: {{ $status[1] }}">{{ $status[0] }}</span>
                    </td>
                    <td scope="col" class="text-nowrap">
                        {{ $item->las_login ? date('H:i:s d/m/Y', strtotime($item->las_login)) : __('not_login') }}
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
