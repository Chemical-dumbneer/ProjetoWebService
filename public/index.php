<?php
    session_start();
    
    require '../control/ticket.control.php';
    require '../control/user.control.php';


   if (!isset($_SESSION['logado'])) {
    validarUsuario();
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