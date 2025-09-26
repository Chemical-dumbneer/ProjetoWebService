<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
    <div class="newUser">
    <div class="form-container">
    

    <form method="POST"  action="../public/index.php?action=cadastrar"  enctype="multipart/form-data">
        <div class="mb-3">
            <label for="foto" class="form-label">Foto:</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>
         <div>
                <img id="preview" class="preview" alt="Prévia da foto">
        </div>

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Usuário</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome">
        </div>

        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Digite seu cargo">
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Função</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="funcao" id="usuario" value="usuario" checked>
                <label class="form-check-label" for="usuario">Usuário</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="funcao" id="tecnico" value="tecnico">
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