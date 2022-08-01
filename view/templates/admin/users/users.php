<?php
require_once __DIR__ . '/../../../includes/header.php';
require_once __DIR__ . '/../../../includes/navbar_admin.php';
?>

<main class="p-5">

    <form method="POST" action="/admin/users/create" class="mb-3">
        <div class="mb-1">
            <label for="username" class="form-label">Novo Username:</label>
            <input type="text" class="form-control form-control-sm" id="username" name="username" maxlength="50">
        </div>
        <div class="mb-1">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control form-control-sm" id="password" name="password">
        </div>
        <div class="mb-2">
            <label for="confirm_password" class="form-label">Confirmar Password:</label>
            <input type="password" class="form-control form-control-sm" id="confirm_password" name="confirm_password">
        </div>
        <button type="submit" class="btn btn-success btn-sm">Criar usuário</button>
    </form>

    <?php require_once __DIR__ . '/../../../includes/alert.php'; ?>
    
    <table class="table table-sm table-responsive table-bordered border-dark">
        <thead>
            <tr>
                <th>Usuários registrados</th>
                <th class="text-center">#</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arrayUsers as $user): ?>
            <tr>
                <td><?= $user->getNameUser(); ?></td>
                <td class="text-center">
                    <a href="/admin/users/delete?id=<?= $user->getIdUser(); ?>" class="btn btn-sm btn-danger">X</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>