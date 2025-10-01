<?php
declare(strict_types=1);

session_start();

// Destrói todas as variáveis de sessão
$_SESSION = [];

// Se quiser, remove o cookie de sessão também
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destrói a sessão
session_destroy();

// Redireciona para a tela de login
header("Location: /index.php");
exit;