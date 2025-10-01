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
   
    $userRepo = new UserRepository();
    $userData = $userRepo->getUserByUsername($usuario);

    $fotoUsuario = $userData ? $userData->getCaminhoFoto() : 'img/users/defaultUserPic.png';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'] ?? '';
        $descricao= $_POST['descricao'] ?? '';
        if (empty($titulo) || empty($descricao)) {
            $error = "Por favor, preencha todos os campos!";
        } else {          
             $repo = new TicketRepository();
            $repo->addTicket($titulo,$descricao, $usuario);
            $sucess = "Ticket cadastrado com sucesso!";
        }
    }
    require __DIR__ . '/../view/newTicket.view.php';
}

function listarTickets(){
    $repo = new TicketRepository();
    $tickets = $repo->getTickets();
    require __DIR__ . '/../view/ticket.view.php';
}

function abrirTimeLine(){
    require __DIR__ . '/../view/ticketTimeline.view.php';
}