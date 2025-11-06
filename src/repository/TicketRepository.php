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

    static function getById(int $id):Ticket {
         $pdo = database::getConnection();
         $stmt = $pdo->prepare( '
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
            WHERE 
                t.id = :id
            ORDER BY t."dataCriacao" DESC
        ');
         $stmt->bindValue(':id', $id, PDO::PARAM_INT);
         $stmt->execute();
         $ticket = $stmt->fetchAll(
            PDO::FETCH_FUNC,
            function ($id, $requerentName, $titulo, $descricao, $dataCriacao, $status) {
                $newTicket = new Ticket(
                    $requerentName,
                    $titulo,
                    $descricao,
                    DateTime::createFromFormat('Y-m-d H:i:s',$dataCriacao),
                    TicketStatus::from($status)
                );
                $newTicket->setId($id);
                return $newTicket;
            }
         )[0];
         $ticket->setId($id);
         return $ticket;
    }

    static function geTicketId(string $requerentName, DateTime $dataCriacao):int {
        $pdo = database::getConnection();
        $stmt = $pdo->prepare( '
            SELECT 
                t.id
            FROM tickets AS t
            JOIN users AS u
                ON t.id_requerent = u.id
            WHERE 
                u.username = :username AND
                t."dataCriacao" = :dataCriacao
        ');
        $stmt->bindValue(':username', $requerentName, PDO::PARAM_INT);
        $stmt->bindValue(':dataCriacao', $dataCriacao, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll()[0];
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
         return $stmt->fetchAll(
             PDO::FETCH_FUNC,
             function ($id, $requerentName, $titulo, $descricao, $dataCriacao, $status) {
                 $newTicket = new Ticket(
                    $requerentName,
                    $titulo,
                    $descricao,
                    DateTime::createFromFormat('Y-m-d H:i:s',$dataCriacao),
                    TicketStatus::from($status)
                );
                 $newTicket->setId($id);
                return $newTicket;
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
        $stmt->execute([':idTicket' => $idTicket]);
        return $stmt->fetchAll(
            PDO::FETCH_FUNC,
            function ($timelinePosition, $authorName, $dateTime, $interactionType, $descricao) {
                return new TicketInteraction(
                    $timelinePosition,
                    $authorName,
                    DateTime::createFromFormat('Y-m-d H:i:s',$dateTime),
                    TicketInteractionType::from($interactionType),
                    $descricao
                );
            }
        );
    }

    static function addTicket(string $titulo, string $descricao, string $usuario):void {
        $ticket = new Ticket(
            requerent: $usuario,
            titulo: $titulo,
            descricao: $descricao,
            dataCriacao: new DateTime('now'),
            status: TicketStatus::Aberto
        );
        $user = UserRepository::getUserByUsername($usuario);
        $pdo = database::getConnection();
        $stmt = $pdo->prepare('
            INSERT INTO
                tickets (
                    "id_requerent", "titulo", "descricao", "dataCriacao", "status"
                )
            VALUES(:id_requerent, :titulo, :descricao, :dataCriacao, :status)
        ');
        $stmt->execute([
            ':id_requerent' => $user->getId(),
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