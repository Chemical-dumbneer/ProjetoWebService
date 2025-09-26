<?php

use entity\ticket;
use entities\user;
require '../model/ticket.php';
// exemplo: simulação de tickets vindos do banco
function getTickets()
{
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
    require '../view/ticket.view.php';
}

function createTicket(){
    $usuario   = $_SESSION['usuario'] ?? 'Anônimo';
    $userModel = new user();
    $userData = $userModel->getUserByUsername($usuario);

    $fotoUsuario = $userData['photoPath'] ?? 'default.png';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'] ?? '';
        $descricao= $_POST['descricao'] ?? '';

        $ticketes = new ticket();
        
        $ticketes->addTicket($titulo,$descricao, $usuario);
        $sucess = "Ticket cadastrado com sucesso!";
    }
    require '../view/newTicket.view.php';
}

function listarTickets(){
    $ticketes = new ticket();
   $tickits = $ticketes->getTickets();

    require '../view/ticket.view.php';
}

function abrirTimeLine(){
    require '../view/ticketTimeline.view.php';
}