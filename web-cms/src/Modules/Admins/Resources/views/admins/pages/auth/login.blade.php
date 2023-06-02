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
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="mail"></i></span>
                    <input type="text" class="form-control" id="login-email" name="login-email"
                        placeholder="example@domain.com" aria-describedby="login-email" tabindex="1" autofocus />
                </div>
            </div>

            <div class="mb-1">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="login-password">Password</label>
                    <a href="#" onclick="showForm(1)">
                        <small>Forgot Password?</small>
                    </a>
                </div>
                <div class="input-group input-group-merge form-password-toggle">
                    <span class="input-group-text"><i data-feather="lock"></i></span>
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
