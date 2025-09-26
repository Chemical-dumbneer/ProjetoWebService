<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de usuarios</title>
    <link rel="stylesheet" href="../public/css/style_std.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<header>
     <nav>
        <a href="../public/index.php?action=newTicket">+ Novo Chamado</a>
         <a href="../public/index.php?action=myTickets">= Meus Chamados</a>
        <a href="../public/index.php?action=cadastrar">Cadastrar usuário</a>
        <a href="../public/index.php?action=listar">Listar usuários</a>

    </nav>
    <div>👤</div>
</header>

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
                            <th scope="col">Cargo</th>
                            <th scope="col">Função</th>
                        </tr>
                    </thead>
                <tbody>
                <?php foreach($users as $u): ?>
                    <tr>
                        <td>
                            <?php if (!empty($u['foto'])): ?>
                                    <img src="<?= htmlspecialchars($u['foto'])?>" alt="Foto" class="table-img" width="50">
                            <?php else: ?>
                                    <span>Sem foto</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($u['nome']) ?></td>
                        <td><?= htmlspecialchars($u['cargo']) ?></td>
                        <td><?= htmlspecialchars($u['funcao']) ?></td>
                    </tr>
                 <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</body>
</html>