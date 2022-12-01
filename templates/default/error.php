<div class="container in py-3">

    <button hidden type="button" class="btn btn-primary" data-toggle="modal" data-target="#Alert"></button>

    <div class="modal fade" id="Alert" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <i class="bi bi-info-circle-fill" style="color: #4256C2"></i> Information
                    </h5>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        <?php echo htmlentities($message) ?>
                    </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="<?php echo htmlentities($target) ?>">
                        <button type="button" class="btn btn-secondary">Okay</button>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = () => {
        document.querySelector('[data-target="#Alert"]').click();
    }
</script>