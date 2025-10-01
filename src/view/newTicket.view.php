<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Novo Chamado</title>
    <link rel="stylesheet" href="/css/style_std.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
    use enum\TipoUsuario;

    require_once __DIR__ . '/partials/header.php'; // ajuste o caminho

    // garanta que a sessão já foi iniciada no front controller (index.php)
    $tipo = $_SESSION['tipo_usuario'] ?? TipoUsuario::Usuario;
    $username = $_SESSION['username'] ?? null;

    renderHeader($tipo, $username);
?>

<body>
    <?php if (!empty($sucess)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($sucess) ?></div>
    <?php endif; ?>

    <?php if(!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
      <?php endif; ?>

    <div class="newTicket">
    <div class="form-container ">
    <div class="profile-container">
        <img src="../uploads/<?= htmlspecialchars($fotoUsuario) ?>" alt="Avatar" style="width:50px; height:50px; border-radius:50%; margin-right:10px;">
        <div><?= $usuario?></div>
    </div>

    <form method="POST" action="/index.php?action=newTicket">
       
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