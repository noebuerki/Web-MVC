<div style="margin-bottom: 100px">
    <div class="d-flex flex-column flex-md-row justify-content-center mt-5">

        <div class="card bg-light mb-3 mx-3">
            <div class="card-body">
                <p class="h5 card-title mb-2">Change Password</p>

                <form method="post" action="/admin/changePassword" class="needs-validation" novalidate>

                    <div class="form-group mb-2">
                        <input required type="text" placeholder="Username" class="form-control"
                               data-toggle="tooltip" title="Enter Username"
                               name="usernameInputPW">
                        <div class="invalid-feedback">Enter Username</div>
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
                               data-toggle="tooltip" title="Repeat new Password"
                               class="form-control" name="passwordRepeatInput" pattern="">
                        <div class="invalid-feedback">Passwords don't match</div>
                    </div>

                    <button type="submit" class="btn btn-secondary" data-toggle="tooltip"
                            title="Save Changes">
                        Save <i class="bi bi-arrow-repeat"></i>
                    </button>

                </form>
            </div>
        </div>

        <div class="card bg-light mb-3 mx-3">
            <div class="card-body">
                <p class="h5 card-title mb-2">Delete Account</p>

                <form method="post" action="/admin/removeUser" class="needs-validation" novalidate>

                    <div class="form-group mb-2">
                        <input required type="text" placeholder="Username" class="form-control"
                               data-toggle="tooltip" title="Enter Username"
                               name="usernameInputRemove">
                        <div class="invalid-feedback">Enter Username</div>
                    </div>

                    <div class="form-group form-check mb-2">
                        <input required type="checkbox" class="form-check-input" id="dataCheckbox"
                               data-toggle="tooltip" title="Confirm">
                        <label for="dataCheckbox" class="form-check-label">
                            Delete Account and Data                
                        </label>
                    </div>

                    <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                            title="Delete Account permanently">
                        Delete <i class="bi bi-trash-fill"></i>
                    </button>

                </form>
            </div>
        </div>
    </div>

    <a href="/admin" role="button" class="position-fixed fixed-buttonpos btn btn-secondary" data-toggle="tooltip"
       title="Back">
        <img src="/images/arrow.svg" width="32" height="32" class="my-1" alt="Left-Facing Arrow, Back">
    </a>
</div>

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
