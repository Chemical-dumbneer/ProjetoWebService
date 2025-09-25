<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visão Geral</title>
    <link rel="stylesheet" href="css/style_std.css">
</head>
<body>

<header>
    <nav>
        <a href="#">+ Novo Chamado</a>
        <a href="#">= Meus Chamados</a>
    </nav>
    <div>👤</div>
</header>

<div class="container">
    <?php foreach($tickets as $t): ?>
    <div class="ticket">
        <div class="avatar">👤</div>
        <div class="content">
            <h3><?= htmlspecialchars($t['titulo']) ?></h3>
            <p><?= htmlspecialchars($t['descricao']) ?></p>
            <div class="usuario"><?= htmlspecialchars($t['usuario']) ?></div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

</body>
</html>