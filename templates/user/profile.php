<div class="d-flex justify-content-center mt-5 mx-1 mx-md-0">

    <div class="card bg-light align-self-center mb-4">
        <div class="card-body">
            <p class="card-text">
                <?php

                use App\Authentication\Authentication;

                echo 'Username: ' . htmlentities($user->username);
                if (Authentication::isAdmin()) {
                    echo ' <span class="badge bg-danger">Admin</span>';
                }
                ?>
            </p>

            <p class="card-text">
                <?php
                echo 'E-Mail: ' . htmlentities($user->email);
                ?>
            </p>

            <p class="card-text text-wrap">
                <?php
                echo 'ApiKey: ' . $user->apiKey;
                ?>
            </p>

            <a href="/user/doRotateApiKey" role="button" class="btn btn-danger" data-toggle="tooltip"
                title="Rotate ApiKey">
                    Rotate ApiKey <i class="bi bi-arrow-repeat"></i>
            </a>
        </div>
    </div>
</div>

<div class="d-flex flex-md-row flex-column justify-content-md-center">

    <div class="row card bg-light mb-3 mx-1 mx-md-0">
        <div class="card-body">
            <p class="card-title mb-2">Change E-Mail</p>

            <form method="post" action="/user/doChangeMail" class="needs-validation" novalidate>

                <div class="form-group mb-2">
                    <input required type="password" placeholder="Password" class="form-control" data-toggle="tooltip"
                        title="Enter Password" name="passwordInput">
                    <div class="invalid-feedback">Enter Password</div>
                </div>

                <div class="form-group mb-2">
                    <input required type="email" placeholder="New E-Mail" class="form-control" name="emailInput"
                        data-toggle="tooltip" title="Enter new E-Mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        maxlength="100">
                    <div class="invalid-feedback">Invalid Format</div>
                </div>

                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Save Changes">
                    Save <i class="bi bi-arrow-repeat"></i>
                </button>

            </form>
        </div>
    </div>

    <div class="row card bg-light mb-3 mx-1 mx-md-4">
        <div class="card-body">
            <p class="card-title mb-2">Change Password</p>

            <form method="post" action="/user/doChangePassword" class="needs-validation" novalidate>

                <div class="form-group mb-2">
                    <input required type="password" placeholder="Current Password" class="form-control"
                        data-toggle="tooltip" title="Enter current Password" name="passwordInput">
                    <div class="invalid-feedback">Enter password</div>
                </div>

                <div class="form-group mb-2">
                    <input required type="password" placeholder="New Password" class="form-control"
                        name="passwordInputNew" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}" maxlength="50"
                        data-toggle="tooltip" title="Enter new Password"
                        oninput="form.passwordRepeatInput.pattern = escapeRegExp(this.value)">
                    <div class="invalid-feedback">Invalid Password</div>
                </div>

                <div class="form-group mb-2">
                    <input required id="passwordRepeatInput" type="password" placeholder="Repeat Password"
                        data-toggle="tooltip" title="Repeat new Password" class="form-control"
                        name="passwordRepeatInput" pattern="">
                    <div class="invalid-feedback">Passwords don't match</div>
                </div>

                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Save Changes">
                    Save <i class="bi bi-arrow-repeat"></i>
                </button>

            </form>
        </div>
    </div>

    <div class="row card bg-light mb-3 mx-1 mx-md-0">
        <div class="card-body">
            <p class="card-title mb-2">Delete Account</p>

            <form method="post" action="/user/doDelete" class="needs-validation" novalidate>

                <div class="form-grou mb-2">
                    <input required type="password" placeholder="Password" class="form-control" data-toggle="tooltip"
                        title="Enter Password" name="passwordInput">
                    <div class="invalid-feedback">Enter Password</div>
                </div>

                <div class="form-group form-check mb-2">
                    <input required type="checkbox" class="form-check-input" id="dataCheckbox" data-toggle="tooltip"
                        title="Confirm">
                    <label for="dataCheckbox" class="form-check-label">
                        Delete Account and Data
                    </label>
                </div>

                <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Delete Account permanently">
                    Delete <i class="bi bi-trash-fill"></i>
                </button>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="RequirementsModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Requirements</h5>
            </div>
            <div class="modal-body">
                <p class="text-left">
                    Your E-Mail must:<br>
                    - Contain the @-Character<br>
                    - Be a Valid E-Mail<br><br>

                    Your Password must:<br>
                    - Have a Length of 8 or more Characters<br>
                    - Contain a Lowercase-Letter<br>
                    - Contain a Uppercase-Letter<br>
                    - Contain a Number<br>
                    - Contain a Special Character<br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Dismiss Requirements">
                    Dismiss
                </button>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-secondary my-5 registerspace" data-bs-toggle="modal" data-bs-target="#RequirementsModal"
    title="Show Requirements">
    <i class="bi bi-clipboard-check"></i> Requirements
</button>

<script>
    /* Form Validation */
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    function escapeRegExp(str) {
        return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
    }
</script>