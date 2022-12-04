<div class="d-flex flex-row justify-content-center mt-5">
    <div class="card bg-light mb-3">
        <div class="card-body">

            <form method="post" action="/user/doCreate" class="needs-validation" novalidate>

                <div class="form-group mb-2">
                    <input required type="text" data-toggle="tooltip" title="Enter Username"
                           placeholder="Username" class="form-control" id="usernameInput" name="usernameInput"
                           maxlength="20" onfocusout="checkUsername(this.value)">
                    <div class="invalid-feedback" id="usernameFeedback"></div>
                </div>

                <div class="form-group mb-2">
                    <input required type="email" data-toggle="tooltip" title="Enter E-Mail" placeholder="E-Mail"
                           class="form-control" name="emailInput"
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="100">
                    <div class="invalid-feedback">Invalid Format</div>
                </div>

                <div class="form-group mb-2">
                    <input required type="password" data-toggle="tooltip" title="Enter Password"
                           placeholder="Password" class="form-control"
                           name="passwordInput" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}" maxlength="50"
                           oninput="form.passwordRepeatInput.pattern = escapeRegExp(this.value)">
                    <div class="invalid-feedback">Invalid Password</div>
                </div>

                <div class="form-group mb-2">
                    <input required id="passwordRepeatInput" data-toggle="tooltip" title="Repeat Password"
                           type="password" placeholder="Repeat Password"
                           class="form-control" name="passwordRepeatInput" pattern="" maxlength="50">
                    <div class="invalid-feedback">Passwords don't match</div>
                </div>

                <div class="form-group form-check mb-2">
                    <input required type="checkbox" class="form-check-input" id="dataCheckbox" data-toggle="tooltip"
                           title="Confirm">
                    <label for="dataCheckbox" class="form-check-label">
                        I accept the Privacy-Statement
                    </label>
                </div>

                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Register">
                    Register <i class="bi bi-arrow-right-short"></i>
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

<button type="button" class="btn btn-secondary mt-5 registerspace" data-bs-toggle="modal" data-bs-target="#RequirementsModal"
    title="Show Requirements">
    <i class="bi bi-clipboard-check"></i> Requirements
</button>

<div class="mt-5">
    <a href="/user/login" class="align-self-end" data-toggle="tooltip" title="Login">
        <p>Already registered?<br>Login</p>
    </a>
</div>

<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    checkUsername(document.getElementById("usernameInput").value);
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    function checkUsername(value) {
        fetch('/user/doCheckUsernameAvailable', {
            method: 'POST',
            body: JSON.stringify({Username: value}),
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            let field = document.getElementById("usernameInput")
            if (!data) {
                document.getElementById("usernameFeedback").innerText = "Username already taken";
                field.setCustomValidity("Taken");
            } else if (!field.value.match(/^[^\s]+$/)) {
                document.getElementById("usernameFeedback").innerText = "Invalid Username";
                field.setCustomValidity("Not matched");
            } else {
                document.getElementById("usernameFeedback").innerText = "";
                field.setCustomValidity("");
            }
        });
    }

    function escapeRegExp(str) {
        return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
    }
</script>