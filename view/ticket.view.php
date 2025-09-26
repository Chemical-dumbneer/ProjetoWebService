<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visão Geral</title>
    <link rel="stylesheet" href="css/style_std.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header>
    <nav>
        <a href="../public/index.php?action=newTicket">+ Novo Chamado</a>
        <a href="../public/index.php?action=myTickets">= Meus Chamados</a>
        <a href="../public/index.php?action=cadastrar">Cadastrar usuário</a>
        <a href="../public/index.php?action=listar">Listar usuários</a>

    </nav>
    <div>👤</div>
</header>

<div class="container">
       <?php if (empty($tickits)): ?>
        <div class="alert alert-warning text-center">
            Não há tickets abertos no momento.
        </div>
    <?php else: ?>
    <?php foreach($tickits as $t): ?>
    <a href="../public/index.php?action=timeLine">
    <div class="ticket">
        <div class="avatar">👤</div>
        <div class="content">
            <h3><?= htmlspecialchars($t['titulo']) ?></h3>
            <p><?= htmlspecialchars($t['descricao']) ?></p>
            <div class="usuario"><?= htmlspecialchars($t['usuario']) ?></div>
        </div>
    </div>
    </a>
    <?php endforeach; ?>
     <?php endif; ?>
</div>

</body>
</html>