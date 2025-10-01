<?php
namespace control;

require_once __DIR__ . '/../repository/TicketRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';
use model\user;
use model\Ticket;
use repository\TicketRepository;
use repository\UserRepository;

function getTickets() {
    $tickets = [
        [
            'usuario' => 'Fulano da Silva',
            'titulo' => 'Meu PC não liga',
            'descricao' => 'Lorem ipsum depois que o encanador trocou o cano o pc desligou'
        ],
        [
            'usuario' => 'Maria Oliveira',
            'titulo' => 'Erro ao acessar sistema',
            'descricao' => 'Sistema retorna tela branca ao logar.'
        ]
    ];
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