<?php
require_once __DIR__ . '/../bootstrap.php';

require_once __DIR__ . '/../src/control/ticket.control.php';
require_once __DIR__ . '/../src/control/user.control.php';


if (!isset($_SESSION['logado'])) {
    validarInfoLogin();
    exit;
}

$action = $_GET['action'] ?? null;

switch ($action) {
    case 'cadastrar':
        cadastrarUser();
        break;

    case 'listar':
        listarUsers();
        break;

    case 'newTicket':
        \control\createTicket();
        break;
    case 'myTickets':
        \control\listarTickets();
        break;
    case 'timeLine':
        \control\abrirTimeLine();
        break;
    default:
        \control\listarTickets();
        break;
}
?>