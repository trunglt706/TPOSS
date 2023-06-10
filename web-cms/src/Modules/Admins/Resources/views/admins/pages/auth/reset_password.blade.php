@extends('admins::admins.layouts.auth')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="auth-wrapper auth-basic px-2">
                <div class="auth-inner my-2">
                    <div class="card mb-0 card-login">
                        <div class="card-body">
                            <a href="#" class="brand-logo">
                                <img src="{{ asset($setting_admin['admin-seo-logo']) }}" height="32">
                            </a>
                            <p class="card-text mb-2 text-center">
                                @lang('reset_header')
                            </p>
                            @include('admins::admins.pages.auth.error')
                            <form class="auth-reset-password-form mt-2" action="{{ route('admin.reset_password') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email ?? '' }}">
                                <input type="hidden" name="token" value="{{ $token ?? '' }}">
                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label for="reset-password" class="form-label">@lang('new_password')</label>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                        <input type="password" class="form-control form-control-merge" id="reset-password"
                                            name="reset-password" tabindex="2"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="reset-password" />
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label for="reset-confirm-password" class="form-label">@lang('password_confirm')</label>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                        <input type="password" class="form-control form-control-merge"
                                            id="reset-confirm-password" name="reset-confirm-password" tabindex="2"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="reset-confirm-password" />
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary w-100 mt-1" tabindex="4">
                                    <i data-feather="send"></i> @lang('reset')
                                </button>
                            </form>
                            <button type="button" onclick="removeReset()" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Quay lại" class="btn btn-icon rounded-circle btn-outline-primary btn-close-top">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var resetForm = $('.auth-reset-password-form');
        if (resetForm.length) {
            resetForm.validate({
                rules: {
                    'reset-password': {
                        required: true,
                    },
                    'reset-confirm-password': {
                        required: true
                    }
                }
            });
        }

        function removeReset() {
            if (confirm("@lang('confirm_leave_page')?")) {
                location.href = "{{ route('admin.login') }}";
            }
        }
    </script>
@endsection
