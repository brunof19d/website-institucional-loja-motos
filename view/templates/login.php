<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-center">
    <div class="box-login">
        <?php require_once __DIR__ . '/../includes/alert.php'; ?>
        <form method="POST" action="/login/controller">
            <div class="mb-1">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control form-control-sm" id="username" name="username">
            </div>
            <div class="mb-1">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control form-control-sm"" id="password" name="password">
            </div>
            <input type="hidden" name="csrf_token" value="<?= $tokenCsrf; ?>">
            <button type="submit" class="btn btn-login btn-sm w-100 mb-1">Login</button>
        </form>
    </div>
</div>
