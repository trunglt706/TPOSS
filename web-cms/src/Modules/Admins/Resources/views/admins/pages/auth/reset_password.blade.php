@extends('admins::admins.layouts.auth')
@section('style')
@endsection

@section('header')
@endsection

@section('sidebar')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="auth-wrapper auth-basic px-2">
                <div class="auth-inner my-2">
                    <!-- Forgot password basic -->
                    <div class="card mb-0">
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
                                <button class="btn btn-primary w-100 mt-2" tabindex="4">
                                    <i data-feather="send"></i> Send
                                </button>
                            </form>
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
            var pageLoginForm = $('.auth-forgot-password-form');
            if (pageLoginForm.length) {
                pageLoginForm.validate({
                    rules: {
                        'login-email': {
                            required: true,
                            email: true
                        },
                    }
                });
            }
        });
    </script>
@endsection
