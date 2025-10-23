<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once "../vendor/autoload.php";


use control\UserControl;
use control\TicketControl;

require_once __DIR__ . '/../bootstrap.php';



if (!isset($_SESSION['logado'])) {
    UserControl::validarInfoLogin();
    exit;
}

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;
switch ($action) {
    case 'cadastrar':
        UserControl::cadastrarUser();
        break;

    case 'listar':
        UserControl::listarUsers();
        break;

    case 'newTicket':
        TicketControl::createTicket();
        break;
    case 'myTickets':
        TicketControl::listarMeusTickets();
        break;
    case 'timeLine':
        TicketControl::abrirTimeLine($id);
        break;
    default:
        TicketControl::listarTickets();
        break;
}
?>