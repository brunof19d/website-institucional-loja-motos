<?php
if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?= $_SESSION['class_bootstrap']; ?>">
        <?= $_SESSION['message']; ?>
    </div>

    <?php
    unset($_SESSION['message']);
    unset($_SESSION['class_bootstrap']);

endif;