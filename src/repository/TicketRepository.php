<?php
namespace repository;

use model\Ticket;
use model\TicketInteraction;
use enum\TicketStatus;
use enum\TicketInteractionType;

class TicketRepository {

     public function __construct() {
        
    }

    function getTickets():array {
         $tickets = $_SESSION['temp_tickets'] ?? [];

        return array_map(function($t) {
            return $t instanceof Ticket ? $t : new Ticket($t['id'] ?? count($_SESSION['temp_tickets'] ?? []) + 1 ,$t['titulo'] ?? 'Sem título',$t['descricao'] ?? '',$t['usuario'] ?? 'Anônimo');
        }, $tickets);
    }

    function getTicketInteractions($idTicket):array {
        foreach ($_SESSION['temp_tickets'] as $ticket) {
            if ($ticket->getId() == $idTicket) {
                return $ticket->getInteractions();
            }
        }
        return [];
    }

    function addTicket(string $titulo, string $descricao, string $usuario):void {
        $id = count($_SESSION['temp_tickets'] ?? []) + 1;
        $ticket = new Ticket($id, $usuario,$titulo, $descricao,);
        if (!isset($_SESSION['temp_tickets'])) {
            $_SESSION['temp_tickets'] = [];
        }
        $_SESSION['temp_tickets'][] = $ticket;
    }

    function addTicketInteraction($idTicket, $novoTicketInteraction):void {
        foreach($_SESSION['temp_tickets'] as &$ticket){
            if($ticket->getId() == $idTicket){
                $ticket->addInteraction($novoTicketInteraction);
                break;
            }
        }
        unset($ticket); 
    }
}