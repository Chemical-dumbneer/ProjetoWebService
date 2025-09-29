<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/css/style_std.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
    use enum\TipoUsuario;

    require_once __DIR__ . '/../partials/header.php'; // ajuste o caminho

    // garanta que a sessão já foi iniciada no front controller (index.php)
    $tipo = $_SESSION['tipo_usuario'] ?? TipoUsuario::Usuario;
    $username = $_SESSION['username'] ?? null;

    renderHeader($tipo, $username);
?>

<body>
    <div class="newUser">
    <div class="form-container">
    <?php if(!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
      <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <form method="POST"  action="/index.php?action=cadastrar"  enctype="multipart/form-data">
        <div class="mb-3">
            <label for="foto" class="form-label">Foto:</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>
         <div>
                <img id="preview" class="preview" alt="Prévia da foto">
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Nome de Usuário</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Digite um nome de usuário">
        </div>

        <div class="mb-3">
            <label for="nomeCompleto" class="form-label">Nome completo</label>
            <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" placeholder="Digite seu nome completo">
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite uma senha forte">
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Função</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="funcao" id="usuario" value=1 checked>
                <label class="form-check-label" for="usuario">Usuário</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="funcao" id="tecnico" value=2>
                <label class="form-check-label" for="tecnico">Técnico</label>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="button"  onclick="window.history.back();" class="btn btn-remove">Voltar</button>
            <button type="submit" class="btn btn-save">Salvar</button>
        </div>
    </form>
</div>
</div>

<script>
        document.getElementById('foto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
                preview.style.display = "none";
            }
        });
</script>
</body>
</html>