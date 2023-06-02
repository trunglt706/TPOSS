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
                <label for="forgot-password-email" class="form-label">Email</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="mail"></i></span>
                    <input type="text" class="form-control" id="forgot-password-email" name="forgot-password-email"
                        placeholder="example@domain.com" aria-describedby="forgot-password-email" tabindex="1"
                        autofocus />
                </div>
            </div>
            <button onclick="showForm(2)" type="button" class="btn btn-primary w-100 mt-1" tabindex="4">
                <i data-feather="send"></i> Send
            </button>
        </form>
        <button type="button" onclick="showForm(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Quay lại"
            class="btn btn-icon rounded-circle btn-outline-primary btn-close-top">
            <i data-feather="x"></i>
        </button>
    </div>
</div>
