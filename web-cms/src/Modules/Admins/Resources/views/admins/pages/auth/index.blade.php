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
                    @include('admins::admins.pages.auth.login')
                    <!-- /Login basic -->

                    <!-- Forgot password basic -->
                    @include('admins::admins.pages.auth.forgot_password')
                    <!-- /Forgot password basic -->

                    <!-- Reset password basic -->
                    @include('admins::admins.pages.auth.reset_password')
                    <!-- /Reset password basic -->
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
                        'forgot-password-email': {
                            required: true,
                            email: true
                        },
                    }
                });
            }

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
        });

        function showForm(_class) {
            $('.card').hide();
            if (_class == 0) {
                $('.card-login').show();
            } else if (_class == 1) {
                $('.card-forgot-password').show();
            } else if (_class == 2) {
                $('.card-reset-password').show();
            }
        }

        function removeReset() {
            if (confirm('Xác nhận rời khỏi chức năng này?')) {
                showForm(0);
            }
        }
    </script>
@endsection
