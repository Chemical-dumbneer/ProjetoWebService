<?php
declare(strict_types=1);

use enum\TipoUsuario;

/**
 * Renderiza o header/nav com base no tipo do usuário.
 */
function renderHeader(TipoUsuario $tipo, ?string $username = null): void {
    // opcional, para exibir quem está logado
    $usernameSafe = $username ? htmlspecialchars($username, ENT_QUOTES, 'UTF-8') : '...';

    ?>
    <header>
        <nav>
            <?php if ($tipo === TipoUsuario::Usuario): ?>
                <a href="/index.php?action=newTicket">+ Novo Chamado</a>
                <a href="/index.php?action=myTickets">= Meus Chamados</a>
            <?php else: ?>
                <a href="/index.php?action=newTicket">+ Novo Chamado</a>
                <a href="/index.php?action=myTickets">= Meus Chamados</a>
                <a href="/index.php?action=cadastrar">Cadastrar usuário</a>
                <a href="/index.php?action=listar">Listar usuários</a>
            <?php endif; ?>
        </nav>
        <div>👤 <?= $usernameSafe ?></div>
    </header>
    <?php
}
