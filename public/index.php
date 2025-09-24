<?php
// exemplo: simulação de tickets vindos do banco
$tickets = [
    [
        'usuario' => 'Fulano da Silva',
        'titulo' => 'Meu PC não liga',
        'descricao' => 'Lorem ipsum depois que o encanador trocou o cano o pc desligou'
    ],
    [
        'usuario' => 'Maria Oliveira',
        'titulo' => 'Erro ao acessar sistema',
        'descricao' => 'Sistema retorna tela branca ao logar.'
    ]
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visão Geral</title>
    <link rel="stylesheet" href="style_std.css">
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