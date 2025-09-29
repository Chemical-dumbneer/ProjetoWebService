<?php
require __DIR__ . '/../bootstrap.php';

require __DIR__ . '/../src/control/ticket.control.php';
require __DIR__ . '/../src/control/user.control.php';


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
        createTicket();
        break;
    case 'myTickets':
        listarTickets();
        break;
    case 'timeLine':
        abrirTimeLine();
        break;
    default:
        getTickets();
        break;
}
?>