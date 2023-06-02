<div class="card mb-0 card-reset-password" style="display: none;">
    <div class="card-body">
        <a href="#" class="brand-logo">
            <img src="../assets/images/logo.png" height="32">
        </a>

        <p class="card-text mb-2 text-center">
            Please sign-in to your account and get on with your work.
        </p>

        <form class="auth-reset-password-form mt-2" action="index.html" method="POST">
            <div class="mb-1">
                <div class="d-flex justify-content-between">
                    <label for="reset-password" class="form-label">Mật khẩu mới</label>
                </div>
                <div class="input-group input-group-merge form-password-toggle">
                    <span class="input-group-text"><i data-feather="lock"></i></span>
                    <input type="password" class="form-control form-control-merge" id="reset-password"
                        name="reset-password" tabindex="2"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="reset-password" />
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                </div>
            </div>
            <div class="mb-1">
                <div class="d-flex justify-content-between">
                    <label for="reset-confirm-password" class="form-label">Mật khẩu xác nhận</label>
                </div>
                <div class="input-group input-group-merge form-password-toggle">
                    <span class="input-group-text"><i data-feather="lock"></i></span>
                    <input type="password" class="form-control form-control-merge" id="reset-confirm-password"
                        name="reset-confirm-password" tabindex="2"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="reset-confirm-password" />
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                </div>
            </div>
            <button type="button" class="btn btn-primary w-100 mt-1" tabindex="4">
                <i data-feather="send"></i> Reset
            </button>
        </form>
        <button type="button" onclick="removeReset()" data-bs-toggle="tooltip" data-bs-placement="top" title="Quay lại"
            class="btn btn-icon rounded-circle btn-outline-primary btn-close-top">
            <i data-feather="x"></i>
        </button>
    </div>
</div>
