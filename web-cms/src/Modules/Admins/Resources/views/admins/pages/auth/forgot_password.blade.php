@extends('admins::admins.layouts.auth')
@section('style')
@endsection

@section('header')
    <style>
        .btn-close-top {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #fff;
        }
    </style>
@endsection

@section('sidebar')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="auth-wrapper auth-basic px-2">
                <div class="auth-inner my-2">
                    <div class="card mb-0 card-forgot-password">
                        <div class="card-body">
                            <a href="#" class="brand-logo">
                                <img src="{{ asset($setting_admin['admin-seo-logo']) }}" height="32">
                            </a>
                            <p class="card-text mb-2 text-center">
                                Please sign-in to your account and get on with your work.
                            </p>
                            <form class="auth-forgot-password-form mt-2" action="index.html" method="POST">
                                <div class="mb-1">
                                    <label for="forgot-password-email" class="form-label">Email</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="mail"></i></span>
                                        <input type="text" class="form-control" id="forgot-password-email"
                                            name="forgot-password-email" placeholder="example@domain.com"
                                            aria-describedby="forgot-password-email" tabindex="1" autofocus />
                                    </div>
                                </div>
                                <button onclick="showForm(2)" type="button" class="btn btn-primary w-100 mt-1"
                                    tabindex="4">
                                    <i data-feather="send"></i> Send
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
        $(function() {
            'use strict';
            // toastr.error('Đăng nhập thất bại!')

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
        });
    </script>
@endsection
