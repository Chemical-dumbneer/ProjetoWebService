<?php
namespace control;
use model\User;

require_once __DIR__ . "/../repository/ticket.repository.php";
require_once __DIR__ . "/../repository/user.repository.php";

function showTickets() {
    require __DIR__ . '/../view/ticket.view.php';
}

function createTicket(){
    $usuario   = $_SESSION['usuario'] ?? 'Anônimo';
    $userData = getUserByUsername($usuario);

    $fotoUsuario = $userData->getCaminhoFoto() ?? 'default.png';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'] ?? '';
        $descricao= $_POST['descricao'] ?? '';
        if (empty($titulo) || empty($descricao)) {
            $error = "Por favor, preencha todos os campos!";
        } else {
            addTicket($titulo,$descricao, $usuario);
            $sucess = "Ticket cadastrado com sucesso!";
        }
    }
    require __DIR__ . '/../view/newTicket.view.php';
}

function listarTickets(){
    $tickits = getTickets();

    require __DIR__ . '/../view/ticket.view.php';
}

function abrirTimeLine(){
    require __DIR__ . '/../view/ticketTimeline.view.php';
}