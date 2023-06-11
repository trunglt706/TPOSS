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
                            <h4 class="card-text mb-2 text-center">
                                @lang('forgot_password_header')
                            </h4>
                            @include('admins::admins.pages.auth.error')
                            <form class="auth-forgot-password-form mt-2" action="{{ route('admin.forgot_password_post') }}"
                                method="POST">
                                @csrf
                                <div class="mb-1">
                                    <label for="login-email" class="form-label">@lang('email')</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="mail"></i></span>
                                        <input type="text" class="form-control" id="login-email" name="login-email"
                                            placeholder="example@domain.com" aria-describedby="login-email" tabindex="1"
                                            autofocus />
                                    </div>
                                </div>
                                <div class="mb-1">
                                    {!! NoCaptcha::display() !!}
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-1" tabindex="4">
                                    <i data-feather="send"></i> @lang('send')
                                </button>
                            </form>
                            <a href="{{ route('admin.login') }}" type="button" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Quay lại"
                                class="btn pjax btn-icon rounded-circle btn-outline-primary btn-close-top">
                                <i data-feather="x"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var forgotPasswordForm = $('.auth-forgot-password-form');
        if (forgotPasswordForm.length) {
            forgotPasswordForm.validate({
                rules: {
                    'forgot-password-email': {
                        required: true,
                        email: true
                    },
                }
            });
        }
    </script>
@endsection
