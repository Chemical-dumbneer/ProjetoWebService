<?php
namespace repository;

use DateTime;
use model\Ticket;
use model\TicketInteraction;
use enum\TicketStatus;
use enum\TicketInteractionType;

class TicketRepository {

     public function __construct() {
        
    }

    static function getTickets():array {
         return $_SESSION['temp_tickets'];
    }

    static function getTicketInteractions($idTicket):array {
        foreach ($_SESSION['temp_tickets'] as $ticket) {
            if ($ticket->getId() == $idTicket) {
                return $ticket->getInteractions();
            }
        }
        return [];
    }

    static function addTicket(string $titulo, string $descricao, string $usuario):void {
        $id = count($_SESSION['temp_tickets'] ?? []) + 1;
        $ticket = new Ticket(
            id: $id,
            requerent: $usuario,
            titulo: $titulo,
            descricao: $descricao,
            dataCriacao: new DateTime('now'),
            status: TicketStatus::Aberto
        );
        if (!isset($_SESSION['temp_tickets'])) {
            $_SESSION['temp_tickets'] = [];
        }
        $_SESSION['temp_tickets'][] = $ticket;
    }

    static function addTicketInteraction($idTicket, $novoTicketInteraction):void {
        foreach($_SESSION['temp_tickets'] as &$ticket){
            if($ticket->getId() == $idTicket){
                $ticket->addInteraction($novoTicketInteraction);
                break;
            }
        }
        unset($ticket); 
    }
}