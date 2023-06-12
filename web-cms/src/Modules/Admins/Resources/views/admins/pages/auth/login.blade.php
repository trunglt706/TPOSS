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
                                @lang('login_header')
                            </h4>
                            @include('admins::admins.pages.auth.error')
                            <form class="auth-login-form mt-2 auth-login" action="{{ route('admin.login_post') }}"
                                method="POST">
                                @csrf
                                <div class="mb-1">
                                    <label for="login-email" class="form-label">@lang('email')</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="mail"></i></span>
                                        <input type="text" class="form-control" id="login-email" name="email"
                                            placeholder="example@domain.com" aria-describedby="login-email" tabindex="1"
                                            autofocus />
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password">@lang('password')</label>
                                        <a href="{{ route('admin.forgot_password') }}">
                                            <small>@lang('forgot_password')?</small>
                                        </a>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <span class="input-group-text"><i data-feather="lock"></i></span>
                                        <input type="password" class="form-control form-control-merge" id="login-password"
                                            name="password" tabindex="2"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="login-password" />
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    {!! NoCaptcha::display() !!}
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-1" tabindex="4">
                                    <i data-feather="log-in"></i> @lang('login')
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var loginForm = $('.auth-login-form');
        if (loginForm.length) {
            loginForm.validate({
                rules: {
                    'login-email': {
                        required: true,
                        email: true
                    },
                    'login-password': {
                        required: true
                    }
                }
            });
        }
    </script>
@endsection
