@extends('admins::admins.layouts.main')
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.index') }}">{{ __('permission_dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('permission_admins') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @if ($menu)
                <div class="content-header-right text-md-end col-md-6 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="d-flex gap-50 justify-content-end sub-nav-list">
                            @foreach ($menu as $item)
                                <a href="{{ $item->route }}"
                                    class="btn btn-outline-primary waves-effect waves-float waves-light">
                                    {{ __($item->name) }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                {!! $permission->icon !!} {{ __($permission->name) }}
                                <span class="total-rows">({{ number_format($data->total()) }})</span>
                            </h4>
                            <div class="heading-elements">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-primary">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="collapse"
                                        href="#collapseFilter" role="button" aria-expanded="false"
                                        aria-controls="collapseFilter">
                                        <i class="fa-solid fa-filter"></i>
                                    </button>
                                    <button type="button" onclick="filterTable()" class="btn btn-outline-primary">
                                        <i class="fa-solid fa-rotate"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="collapse" id="collapseFilter">
                                <div class="d-flex p-1 border">
                                    <form class="form-filter w-100">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <label class="form-label">@lang('permission_admin_groups')</label>
                                                <select name="group_id" class="select2 form-select"
                                                    onchange="filterTable()">
                                                    <option value="">--- @lang('all') ---</option>
                                                    @foreach ($groups as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-1">
                                                <label class="form-label">@lang('status')</label>
                                                <select name="status" class="select2 form-select" onchange="filterTable()">
                                                    <option value="">--- @lang('all') ---</option>
                                                    @foreach ($status as $key => $item)
                                                        <option value="{{ $key }}">{{ $item[0] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-6 mb-1">
                                                <label class="form-label">@lang('total_row')</label>
                                                <select name="limit" class="select2 form-select" onchange="filterTable()">
                                                    <option value="10">10</option>
                                                    <option value="100">100</option>
                                                    <option value="1000">1,000</option>
                                                    <option value="10000">10,000</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-1">
                                                <label class="form-label">@lang('search')</label>
                                                <input type="text" name="search" class="form-control">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive table-content">
                                @include('admins::admins.pages.admins.tables.admins')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal confirm asigned for admin --}}
        <div class="modal fade text-start modal-danger modalDelete" id="default" aria-labelledby="modalDelete"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">@lang('delete_data')</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-submit-delete">
                            <i class="fa-solid fa-check"></i> @lang('confirm')
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal confirm asigned for admin --}}
    </div>
@endsection

@section('script')
    <script>
        function filterTable(page = 1) {
            var data = $('form').serialize();
            show_loading($(".table-content"));
            load_ajax("{{ route('admin.admins.list') }}?page=" + page + "&" + data, $('.table-responsive'), true);
        }

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            filterTable(page);
        });

        function deleteAdmin(id) {
            if (confirm("@lang('confirm_delete_data')")) {
                $('.modalDelete .modal-body').html(`
                    <div class="text-center">
                            <div class="spinner-border text-danger" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                `);
                $('.modalDelete').modal('show');
                load_ajax("{{ route('admin.admins.assigned') }}?id=" + id, $('.modalDelete .modal-body'), true);
            }
        }

        $('.btn-submit-delete').click(function() {
            $('.btn-submit-delete').addClass('disabled');
            show_loading($(".modalDelete"));
            var deleted_id = $('.deleted_id').val();
            var assigned_id = $('.assigned_id').val();
            var url = "{{ route('admin.admins.destroy', ':id') }}";
            $.post(url.replace(':id', deleted_id), {
                assigned_id: assigned_id
            }, function(data) {
                if (data['status']) {
                    $('#tr-' + deleted_id).remove();
                    $('.modalDelete').modal('hide');
                    toastr.success(data['message']);
                } else {
                    $('.delete-error').text(data['message']);
                }
                hide_loading($(".modalDelete"));
                $('.btn-submit-delete').removeClass('disabled');
            });
        });
    </script>
@endsection
