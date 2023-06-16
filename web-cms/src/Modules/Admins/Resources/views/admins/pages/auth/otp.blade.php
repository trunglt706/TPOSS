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
                                @lang('otp_header')
                            </h4>
                            @include('admins::admins.pages.auth.error')
                            <form class="auth-otp-form mt-2 auth-otp" action="{{ route('admin.otp_post') }}" method="POST">
                                @csrf
                                <div class="mb-1">
                                    <label for="login-otp" class="form-label">@lang('otp')</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="key"></i></span>
                                        <input type="text" class="form-control" id="login-otp" name="otp"
                                            placeholder="example@domain.com" aria-describedby="login-otp" tabindex="1"
                                            autofocus />
                                    </div>
                                </div>
                                <div class="mt-1">
                                    {!! NoCaptcha::display() !!}
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-1" tabindex="4">
                                    <i data-feather="log-in"></i> @lang('confirm')
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
        var otpForm = $('.auth-otp-form');
        if (otpForm.length) {
            otpForm.validate({
                rules: {
                    'login-otp': {
                        required: true,
                        number: true
                    },
                }
            });
        }
    </script>
@endsection
