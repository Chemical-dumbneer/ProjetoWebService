<?php

use model\Ticket;
use model\TicketInteraction;
use enum\TicketStatus;
use enum\TicketInteractionType;

function getTickets():array {
    return $_SESSION['temp_tickets'];
}

function getTicketInteractions($idTicket):array {
    foreach ($_SESSION['temp_tickets'] as $ticket) {
        if ($ticket->getId() == $idTicket) {
            return $ticket->getInteractions();
        }
    }
    return [];
}

function addTicket($novoTicket):void {
    $_SESSION['temp_tickets'][]  = $novoTicket;
}

function addTicketInteraction($idTicket, $novoTicketInteraction):void {
    foreach($_SESSION['temp_tickets'] as $ticket){
        if($ticket->getId() == $idTicket){
            $ticket->addInteraction($novoTicketInteraction);
        }
    }
}