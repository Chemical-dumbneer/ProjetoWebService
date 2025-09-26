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
        <a href="#">+ Novo Chamado</a>
        <a href="#">= Meus Chamados</a>
    </nav>
    <div>👤</div>
</header>

<body>
    <div class="newTicket">
    <div class="form-container ">
    <div class="profile-container">
        <div class="profile">👤</div>
        <div>Fulano da Silva</div>
    </div>

    <form method="POST" action="../public/index.php?action=newTicket">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título do chamado</label>
            <input type="text" class="form-control" id="titulo" placeholder="Digite o título">
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" rows="6" placeholder="Digite a descrição"></textarea>
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