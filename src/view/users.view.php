<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de usuarios</title>
    <link rel="stylesheet" href="/css/style_std.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
    use enum\TipoUsuario;

    require_once __DIR__ . '/partials/header.php'; // ajuste o caminho

    // garanta que a sessão já foi iniciada no front controller (index.php)
    $tipo = $_SESSION['tipoUsuario'] ?? TipoUsuario::Usuario;
    $username = $_SESSION['usuario'] ?? null;
    $foto = $_SESSION['fotoUsuario'] ?? null;
    renderHeader($tipo, $username,$foto);
?>

<body>
    <div class="users">
        <div class="container mt-5">
        <h2 class="mb-4">Tabela de Usuários</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Nome</th>
                            <th scope="col">username</th>
                            <th scope="col">Função</th>
                        </tr>
                    </thead>
                <tbody>
                <?php foreach($users as $u): ?>
                    <tr>
                        <td>
                            <?php if (!empty($u->getCaminhoFoto())): ?>
                                    <img src="<?= htmlspecialchars($u->getCaminhoFoto())?>" alt="Foto" class="table-img" width="50">
                            <?php else: ?>
                                    <span>Sem foto</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($u->getUsername()) ?></td>
                        <td><?= htmlspecialchars($u->getNomeCompleto()) ?></td>
                        <td><?= htmlspecialchars($u->getTipoUsuario()->getDescricao()) ?></td>
                    </tr>
                 <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</body>
</html>