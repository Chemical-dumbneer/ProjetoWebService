<?php
namespace repository;

use Database;
use DateTime;
use model\Ticket;
use model\TicketInteraction;
use enum\TicketStatus;
use enum\TicketInteractionType;
use PDO;

class TicketRepository {

     public function __construct() {
        
    }

    static function getTickets():array {
         $pdo = database::getConnection();
         $stmt = $pdo->prepare('
            SELECT 
                t.id, 
                u.username, 
                t.titulo, 
                t.descricao, 
                t."dataCriacao", 
                t.status
            FROM tickets AS t
            JOIN users AS u
                ON t.id_requerent = u.id
            ORDER BY t."dataCriacao" DESC
         ');
         $stmt->execute();
         return $stmt->fetch(
             PDO::FETCH_FUNC,
             function ($id, $requerentName, $titulo, $descricao, $dataCriacao, $status) {
                return new Ticket(
                    $id,
                    $requerentName,
                    $titulo,
                    $descricao,
                    DateTime::createFromTimestamp($dataCriacao),
                    TicketStatus::from($status));
             }
         );
    }

    static function getTicketInteractions($idTicket):array {
        $pdo = database::getConnection();
        $stmt = $pdo->prepare('
            SELECT
                i."timelinePosition",
                u.username,
                i.datetime,
                i."interactionType",
                i.descricao
            FROM
                "ticketInteractions" AS i
            JOIN
                users AS u ON
                    i.id_author = u.id
            WHERE
                i.id_ticket = :idTicket
            ORDER BY
                i."timelinePosition"
        ');
        $stmt->execute(
            [':idTicket' => $idTicket]
        );
        return $stmt->fetchAll(
            PDO::FETCH_FUNC,
            function ($timelinePosition, $authorName, $dateTime, $interactionType, $descricao) {
                return new TicketInteraction(
                    $timelinePosition,
                    $authorName,
                    DateTime::createFromTimestamp($dateTime),
                    TicketInteractionType::from($interactionType),
                    $descricao
                );
            }
        );
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
        $pdo = database::getConnection();
        $stmt = $pdo->prepare('
            INSERT INTO
                tickets (
                    "id_requerent", "titulo", "descricao", "dataCriacao", "status"
                )
            VALUES(:id_requerent, :titulo, :descricao, :dataCriacao, :status)
        ');
        $stmt->execute([
            ':id_requerent' => $ticket->getId(),
            ':titulo' => $ticket->getTitulo(),
            ':descricao' => $ticket->getDescricao(),
            ':dataCriacao' => $ticket->getDataCriacao()->format('Y-m-d H:i:s'),
            ':status' => $ticket->getStatus()->value
        ]);
    }

    static function addTicketInteraction($idTicket, $novoTicketInteraction):void {
        $pdo = database::getConnection();
        $stmt = $pdo->prepare('
            INSERT INTO
                "ticketInteractions" (
                    "id_ticket", "timelinePosition", "id_author", "datetime", "interactionType", "descricao"
                )
            VALUES(
                :id_ticket, :timelinePosition, :id_author, :dateTime, :interactionType, :descricao
            )
        ');
        $stmt->execute([
            ":id_ticket" => $idTicket,
            ":timelinePosition" => $novoTicketInteraction->getTimelinePosition(),
            ":id_author" => $novoTicketInteraction->getAuthor()->getId(),
            ":dateTime" => $novoTicketInteraction->getDateTime()->format('Y-m-d H:i:s'),
            ":interactionType" => $novoTicketInteraction->getInteractionType()->value,
            ":descricao" => $novoTicketInteraction->getDescricao()
        ]);
    }
}