<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visão Geral</title>
    <link rel="stylesheet" href="/css/style_std.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
    use enum\TipoUsuario;

    require_once __DIR__ . '/partials/header.php'; // ajuste o caminho

    // garanta que a sessão já foi iniciada no front controller (index.php)
    $tipo = $_SESSION['tipoUsuario'] ?? TipoUsuario::Usuario;
    $username = $_SESSION['usuario'] ?? null;

    renderHeader($tipo, $username);
?>

<div class="container">
       <?php if (empty($tickets)): ?>
        <div class="alert alert-warning text-center">
            Não há tickets abertos no momento.
        </div>
    <?php else: ?>
    <?php foreach($tickets as $t): ?>
        <a href="/index.php?action=timeLine&id=<?= $t->getId() ?>" class="ticket-link">
            <div class="ticket">
                <div class="avatar">👤</div>
                <div class="content">
                    <h3 ><?= htmlspecialchars($t->getTitulo()) ?></h3>
                    <p ><?= htmlspecialchars($t->getDescricao()) ?></p>
                    <p>• Criado em: <?= $t->getDataCriacao()->format('d/m/Y H:i') ?></p>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
     <?php endif; ?>
</div>

</body>
</html>