<div class="modal fade text-start modal-primary modalCreate" id="modalCreate" aria-labelledby="modalCreate"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form form-create" method="post" action="{{ route('admin.admins.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-uppercase">@lang('create_new_admin')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-error text-danger mb-1"></div>
                    <ul class="nav nav-tabs justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="tab-basic" data-bs-toggle="tab" href="#basic"
                                aria-controls="basic" role="tab" aria-selected="true">@lang('basic')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="tab-other" data-bs-toggle="tab" href="#other"
                                aria-controls="other" role="tab" aria-selected="false">@lang('other_info')</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="basic" aria-labelledby="tab-basic" role="tabpanel">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="create-name">@lang('name') *</label>
                                        <input type="text" id="create-name" class="form-control" name="name" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label">@lang('permission_admin_groups') *</label>
                                        <select name="group_id" id="create-group-id" class="select2 form-select">
                                            @foreach ($groups as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="create-email">@lang('email') *</label>
                                        <input type="email" id="create-email" class="form-control" name="email" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="create-password">@lang('password')
                                            *</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge"
                                                id="create-password" name="password" tabindex="2"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="login-password" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <div class="form-check">
                                            <input type="checkbox" name="supper" class="form-check-input"
                                                id="create-supper" />
                                            <label class="form-check-label" for="create-supper">@lang('account_supper_1')
                                                <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="@lang('warning_no_select_full_permission')"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="other" aria-labelledby="tab-other" role="tabpanel">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="create-phone">@lang('phone')</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">(+84)</span>
                                            <input type="text" class="form-control phone-number-mask"
                                                placeholder="1 234 567 8900" name="phone" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label">@lang('gender')</label>
                                        <select name="gender" class="select2 form-select">
                                            @foreach ($gender as $key => $item)
                                                <option value="{{ $key }}">{{ $item[0] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label">@lang('birthday')</label>
                                        <input type="text" id="fp-default" class="form-control flatpickr-basic"
                                            name="birthday" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label">@lang('tax_code')</label>
                                        <input type="text" name="tax_code"
                                            class="form-control credit-card-mask" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="create-address">@lang('address')</label>
                                        <textarea name="address" id="create-address" class="form-control"></textarea>
                                    </div>
                                </div>
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
