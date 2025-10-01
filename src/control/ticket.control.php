<?php
namespace control;
use model\User;
use model\TicketInteraction;
use enum\TicketInteractionType;

require_once __DIR__ . "/../repository/TicketRepository.php";
require_once __DIR__ . "/../repository/UserRepository.php";
use repository\TicketRepository;
use repository\UserRepository;
use DateTime;

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

function abrirTimeLine($ticketId){
    $ticketIdSelecionado = $ticketId;
    $ticket = null;
    $userRepo = new UserRepository();
    $mensagem = $_POST['mensagem'] ?? null;
    $tipo_ticket = $_POST['tipo_ticket'] ?? null;
    $usuario = $_SESSION['username'] ?? null;

    foreach ($_SESSION['temp_tickets'] as $t) {
        if ($t->getId() == $ticketIdSelecionado) {
            $ticket = $t;
            break;
        }
    }

    if (!$ticket) {
        echo "<p>Ticket não encontrado!</p>";
        return;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['mensagem'])) {
         $tipoSelecionado = $_POST['InteractionType'] ?? 'FollowUp';
        $tipoEnum = TicketInteractionType::getFromText($tipoSelecionado);

        $ticket->addInteraction(new TicketInteraction(
            timelinePosition: count($ticket->getInteractions()) + 1,
            author: $_SESSION['usuario'],
            datetime: new DateTime(),
            interactionType: $tipoEnum,
            descricao: htmlspecialchars($_POST['mensagem'])
        ));
    }

    $interactions = $ticket->getInteractions();

    require __DIR__ . '/../view/ticketTimeline.view.php';
}

function adicionarInteracao(){
    $ticketId = $_GET['id'] ?? null;
    $mensagem = $_POST['mensagem'] ?? null;
    $tipo_ticket = $_POST['tipo_ticket'] ?? null;
    $usuario = $_SESSION['username'] ?? null;
    $ticketRepo = new TicketRepository();

    if(!isset($_SESSION['nextInteractionId'])){
        $_SESSION['nextInteractionId'] = 1;
    }

    $novoId = $_SESSION['nextInteractionId']++;

    if (!$ticketId || !$mensagem || !$tipo_ticket || !$usuario) {
            header("Location: index.php?controller=ticket&action=abrirTimeLine&id=$ticketId");
            $erro = "Escreva uma mensagem, antes de enviar!";
            exit;
        }
    
        $tipoEnum = TicketInteractionType::getFromText($tipo_ticket);

        $interaction = new TicketInteraction(
            $novoId,             
            $usuario,         
            new \DateTime(),  
            $mensagem,
            $tipo_ticket
        );
         $ticketRepo->addTicketInteraction($ticketId, $interaction);

        header("Location: index.php?controller=ticket&action=abrirTimeLine&id=$ticketId");
}
