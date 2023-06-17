@php
    use Modules\Admins\Entities\Admins;
@endphp
<table class="table position-relative">
    <thead>
        <tr>
            <th>@lang('action')</th>
            <th>@lang('name')</th>
            <th>@lang('phone')</th>
            <th>@lang('email')</th>
            <th>@lang('status')</th>
            <th>@lang('last_login')</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->count() > 0)
            @foreach ($data as $item)
                @php
                    $status = Admins::get_status($item->status);
                @endphp
                <tr>
                    <td>
                        @if (admin_menu_check_role('admins|edit'))
                            <a href="{{ route('admin.admins.detail', ['id' => $item->id]) }}"
                                class="btn btn-sm btn-icon btn-outline-primary">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                        @endif
                        @if (admin_menu_check_role('admins|delete'))
                            <button onclick="deleteAdmin('{{ $item->id }}')" type="button"
                                class="btn btn-sm btn-icon btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.admins.detail', ['id' => $item->id]) }}" data-bs-toggle="tooltip"
                            data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up my-0"
                            title="{{ $item->name }}">
                            <img src="../assets/images/avatars/avatar-1.jpg" alt="Avatar" height="26"
                                width="26" />
                        </a>
                        <span class="fw-bold">{{ $item->name }}</span>
                    </td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <span class="badge rounded-pill me-1 text-light"
                            style="background: {{ $status[1] }}">{{ $status[0] }}</span>
                    </td>
                    <td>
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
