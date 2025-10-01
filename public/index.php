<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/../bootstrap.php';

require_once __DIR__ . '/../src/control/ticket.control.php';
require_once __DIR__ . '/../src/control/user.control.php';


if (!isset($_SESSION['logado'])) {
    \control\validarInfoLogin();
    exit;
}

$action = $_GET['action'] ?? null;

switch ($action) {
    case 'cadastrar':
        \control\cadastrarUser();
        break;

    case 'listar':
        \control\listarUsers();
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
        \control\showTickets();
        break;
}
?>