<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Novo Chamado</title>
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
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <div class="newTicket">
    <div class="form-container ">
    <div class="profile-container">
        <img src="../uploads/<?= htmlspecialchars($fotoUsuario) ?>" alt="Avatar" style="width:50px; height:50px; border-radius:50%; margin-right:10px;">
        <div><?= $usuario?></div>
    </div>

    <form method="POST" action="../public/index.php?action=newTicket">
       
        <div class="mb-3">
            <label for="titulo" class="form-label">Título do chamado</label>
            <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Digite o título">
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao"   name="descricao"rows="6" placeholder="Digite a descrição"></textarea>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-submit">Enviar</button>
        </div>
    </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>