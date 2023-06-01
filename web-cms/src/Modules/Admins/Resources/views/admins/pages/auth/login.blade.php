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
                    <!-- Login basic -->
                    <div class="card mb-0 card-login">
                        <div class="card-body">
                            <a href="#" class="brand-logo">
                                <img src="../assets/images/logo.png" height="32">
                            </a>

                            <p class="card-text mb-2 text-center">
                                Please sign-in to your account and get on with your work.
                            </p>

                            <form class="auth-login-form mt-2" action="index.html" method="POST">
                                <div class="mb-1">
                                    <label for="login-email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="login-email" name="login-email"
                                        placeholder="example@domain.com" aria-describedby="login-email" tabindex="1"
                                        autofocus />
                                </div>

                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password">Password</label>
                                        <a href="#" onclick="showForm(1)">
                                            <small>Forgot Password?</small>
                                        </a>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" id="login-password"
                                            name="login-password" tabindex="2"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="login-password" />
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100 mt-1" tabindex="4">
                                    <i data-feather="log-in"></i> Sign in
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- /Login basic -->

                    <!-- Forgot password basic -->
                    <div class="card mb-0 card-forgot-password" style="display: none;">
                        <div class="card-body">
                            <a href="#" class="brand-logo">
                                <img src="../assets/images/logo.png" height="32">
                            </a>

                            <p class="card-text mb-2 text-center">
                                Please sign-in to your account and get on with your work.
                            </p>

                            <form class="auth-forgot-password-form mt-2" action="index.html" method="POST">
                                <div class="mb-1">
                                    <label for="login-email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="login-email" name="login-email"
                                        placeholder="example@domain.com" aria-describedby="login-email" tabindex="1"
                                        autofocus />
                                </div>
                                <button class="btn btn-primary w-100 mt-1" tabindex="4">
                                    <i data-feather="send"></i> Send
                                </button>
                            </form>
                            <button type="button" onclick="showForm(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Quay lại" class="btn btn-icon rounded-circle btn-outline-primary btn-close-top">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /Forgot password basic -->
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

            var forgotPasswordForm = $('.auth-forgot-password-form');
            if (forgotPasswordForm.length) {
                forgotPasswordForm.validate({
                    rules: {
                        'login-email': {
                            required: true,
                            email: true
                        },
                    }
                });
            }
        });

        function showForm(_class) {
            $('.card').hide();
            if (_class == 0) {
                $('.card-login').show();
            } else if (_class == 1) {
                $('.card-forgot-password').show();
            }
        }
    </script>
@endsection
