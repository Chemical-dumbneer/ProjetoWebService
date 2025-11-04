<?php
declare(strict_types=1);

use enum\TipoUsuario;

/**
 * Renderiza o header/nav com base no tipo do usuário.
 */
function renderHeader(TipoUsuario $tipo, ?string $username = null, ?string $foto = null): void {
    // Nome do usuário tratado para evitar XSS
    $usernameSafe = $username ? htmlspecialchars($username, ENT_QUOTES, 'UTF-8') : '...';

    // Se tiver foto do usuário, usa; senão, coloca padrão
    $fotoSrc = $foto && file_exists($foto) ? $foto : '/assets/img/user-default.png';
    ?>
    <header>
        <nav>
            <?php if ($tipo === TipoUsuario::Usuario): ?>
                <a href="/ticket/new">+ Novo Chamado</a>
                <a href="/ticket/my">= Meus Chamados</a>
            <?php elseif ($tipo === TipoUsuario::Tecnico): ?>
                <a href="/ticket/new">+ Novo Chamado</a>
                <a href="/ticket/my">= Meus Chamados</a>
                <a href="/home">> Listar Chamados</a>
                <a href="/user/new">+ Cadastrar usuário</a>
                <a href="/user/listar">> Listar usuários</a>
            <?php endif; ?>
        </nav>

        <!-- Menu do usuário -->
        <div class="user-menu" style="position: relative; display: inline-block;">
            <button style="background: none; border: none; cursor: pointer; display: flex; align-items: center;" onclick="toggleUserMenu()">
                <img src="<?= htmlspecialchars($fotoSrc, ENT_QUOTES, 'UTF-8') ?>"
                     alt="Foto do usuário"
                     style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 8px;">
                <span><?= $usernameSafe ?></span>
            </button>
            <div id="userDropdown" style="display: none; position: absolute; right: 0; top: 100%; background: white; border: 1px solid #ccc; border-radius: 4px; min-width: 150px; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);">
                <!-- <a href="/index.php?action=perfil" style="display: block; padding: 10px; text-decoration: none; color: black;">Meu Perfil</a> -->
                <a href="/logout" style="display: block; padding: 10px; text-decoration: none; color: red;">Sair</a>
            </div>
        </div>

        <script>
            function toggleUserMenu() {
                const menu = document.getElementById('userDropdown');
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            }
            document.addEventListener('click', function(event) {
                const dropdown = document.getElementById('userDropdown');
                const button = document.querySelector('.user-menu button');
                if (!button.contains(event.target)) {
                    dropdown.style.display = 'none';
                }
            });
        </script>
    </header>
    <?php
}
