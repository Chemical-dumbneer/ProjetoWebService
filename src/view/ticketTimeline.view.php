<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket: <?= htmlspecialchars($ticket->getTitulo()) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style_std.css">
</head>

<?php
    use enum\TipoUsuario;
    use repository\TicketRepository;
    use repository\UserRepository;

    require_once __DIR__ . '/partials/header.php'; // ajuste o caminho
    $ticket = $_SESSION['CurrentTicket'];
    // garanta que a sessão já foi iniciada no front controller (index.php)
    $tipo = $_SESSION['tipoUsuario'] ?? TipoUsuario::Usuario;
    $username = $_SESSION['usuario'] ?? null;
    $foto = $_SESSION['fotoUsuario'] ?? null;
    renderHeader($tipo, $username,$foto);
?>

<body>
    <?php if(!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
      <?php endif; ?>
    <div class="container py-4">
    <h3><strong>Título: <?= htmlspecialchars($ticket->getTitulo()) ?></strong></h3>
        <h4>Descrição: <?= htmlspecialchars($ticket->getDescricao()) ?></h4>

    <div class="d-flex flex-column ">
        <?php foreach($interactionsViewData as $data):
            $i = $data['interaction'];
            $foto = $data['foto'];
            $classes = $data['classes'];
        ?>

        <div class="card p-3 mb-2 <?php echo $classes; ?>" style="max-width: 70%;">
            <div class="d-flex justify-content-between align-items-start">
                <div class="d-flex align-items-center">
                    <img src="<?=$foto?>" class="rounded-circle bg-secondary text-white me-3" style="width:40px; height:40px; display:flex; justify-content:center; align-items:center;">
                    <strong><?php echo htmlspecialchars($i->getAuthor()); ?></strong>
                </div>
                <small class="text-muted"><?php echo $i->getDatetime()->format('d/m/Y H:i'); ?></small>
            </div>
            <div class="mt-2">
                <p class="card-text"><?php echo htmlspecialchars($i->getDescricao()); ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <form method="post" class="mt-3" action="/ticket/<?php $ticket->getId()?>/timeline/newInteraction">
        <div class="mb-3">
        <?php if(isset($tipo) && $tipo === TipoUsuario::Tecnico):?>
        <label class="form-label"><strong>Tipo de Resposta:</strong></label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo_ticket" id="tipo_followUp" value="FollowUp" checked>
            <label class="form-check-label" for="tipo_followUp">FollowUp</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo_ticket" id="tipo_task" value="Task">
            <label class="form-check-label" for="tipo_task">Task</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo_ticket" id="tipo_solution" value="Solution">
            <label class="form-check-label" for="tipo_solution">Solution</label>
        </div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <textarea name="mensagem" class="form-control" placeholder="Digite sua resposta" rows="3" ></textarea>
    </div>

    <button type="submit" class="btn btn-success">Enviar</button>
    </form>
</div>
</body>
</html>