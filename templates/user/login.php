<div class="d-flex justify-content-center mt-5">
    <div class="card bg-light mb-3">
        <div class="card-body">

            <form action="/user/doLogin" method="post" class="needs-validation" novalidate>

                <div class="form-group mb-2">
                    <input required type="text" placeholder="Username" class="form-control" data-toggle="tooltip"
                           title="Enter Username"
                           name="usernameInput">
                    <div class="invalid-feedback">Enter Username</div>
                </div>

                <div class="form-group mb-2">
                    <input required type="password" placeholder="Password" class="form-control" data-toggle="tooltip"
                           title="Enter Password"
                           name="passwordInput">
                    <div class="invalid-feedback">Enter Password</div>
                </div>

                <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Login">
                    Login <i class="bi bi-arrow-right-short"></i>
                </button>

            </form>
        </div>
    </div>
</div>

<div class="mt-5">
    <a href="/user/register" class="align-self-end" data-toggle="tooltip" title="Register"><p>Not yet registered?<br>Register</p></a>
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