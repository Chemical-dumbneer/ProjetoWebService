<?php
namespace control;
use model\Ticket;
use model\User;
use model\TicketInteraction;
use repository\TicketRepository;
use repository\UserRepository;
use enum\TicketInteractionType;
use enum\TipoUsuario;
use DateTime;
use Pecee\SimpleRouter\SimpleRouter;
class TicketControl {

    public function __construct() {
        
    }

    static function showTickets(): void {
        require __DIR__ . '/../view/ticket.view.php';
    }

    static function createTicket(): void {
        $usuario = $_SESSION['usuario'] ?? 'Anônimo';
        $userData = UserRepository::getUserByUsername($usuario);

        $fotoUsuario =  $userData?->getCaminhoFoto() ?? 'img/users/defaultUserPic.png';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            if (empty($titulo) || empty($descricao)) {
                $error = "Por favor, preencha todos os campos!";
            } else {
                TicketRepository::addTicket($titulo, $descricao, $usuario);
                $sucess = "Ticket cadastrado com sucesso!";
            }
        }
        require __DIR__ . '/../view/newTicket.view.php';
    }

    static function listarTickets(): void {
        $tickets = TicketRepository::getTickets();
        require __DIR__ . '/../view/ticket.view.php';
    }

    static function listarMeusTickets(): void {
        /** @var Ticket $tickets */
        $tickets = [];
        foreach (TicketRepository::getTickets() as $ticket) {
            if($ticket->getRequerentUsername() == $_SESSION['usuario']){
                $tickets[] = $ticket;
            }
        }

        require __DIR__ . '/../view/ticket.view.php';
    }

    static function abrirTimeLine($ticketId): void {
        $ticketIdSelecionado = $ticketId;
        $ticket = null;
        $mensagem = $_POST['mensagem'] ?? null;
        $tipo_ticket = $_POST['tipo_ticket'] ?? null;
        $usuario = $_SESSION['username'] ?? null;


        $ticket = TicketRepository::getById($ticketId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['mensagem'])) {
            $tipoSelecionado = $_POST['tipo_ticket'] ?? 'FollowUp';
            $tipoEnum = TicketInteractionType::getFromText($tipoSelecionado);

            $ticket->addInteraction(
                new TicketInteraction(
                    timelinePosition: count($ticket->getInteractions()) + 1,
                    author: $_SESSION['usuario'],
                    datetime: new DateTime(),
                    interactionType: $tipoEnum,
                    descricao: htmlspecialchars($_POST['mensagem'])
                )
            );
        }
        $interactions = TicketRepository::getTicketInteractions($ticketId);
        $interactionsViewData =self::prepararInteracao($interactions);
        require __DIR__ . '/../view/ticketTimeline.view.php';
    }

    static function adicionarInteracao(): void {
        $ticketId = $_GET['id'] ?? null;
        $mensagem = $_POST['mensagem'] ?? null;
        $tipo_ticket = $_POST['tipo_ticket'] ?? null;
        $usuario = $_SESSION['username'] ?? null;

        if (!isset($_SESSION['nextInteractionId'])) {
            $_SESSION['nextInteractionId'] = 1;
        }

        $novoId = $_SESSION['nextInteractionId']++;

        if (!$ticketId || !$mensagem || !$tipo_ticket || !$usuario) {
            header("Location: /ticket/<?=$ticketId ?>/timeline");
            $erro = "Escreva uma mensagem, antes de enviar!";
            exit;
        }

        $tipoEnum = TicketInteractionType::getFromText($tipo_ticket);

        $interaction = new TicketInteraction(
            $novoId,
            $usuario,
            new DateTime('now'),
            $mensagem,
            $tipo_ticket
        );
        TicketRepository::addTicketInteraction($ticketId, $interaction);

        header("Location: /ticket/<?=$ticketId ?>/timeline");
    }

    static function prepararInteracao(array $interactions): array{
        $result = [];
        foreach($interactions as $i){
                $author = $i->getAuthor();
                $user = UserRepository::getUserByUsername($author); 
                $tipoUsuario = $user->getTipoUsuario();
                $isUsuario = $tipoUsuario === TipoUsuario::Usuario;
                $foto = $user?->getCaminhoFoto() ?? '/img/users/defaultUserPic.png';

                switch($i->getInteractionType()->name) {
                    case 'Task':
                        $colorClass = 'bg-warning text-dark';
                        break;
                    case 'Solution':
                        $colorClass = 'bg-success text-white';
                        break;
                    case 'FollowUp':
                    default:
                        $colorClass = 'bg-info text-white';
                        break;
                }
                 $classes = $isUsuario ? "align-self-start bg-light border-start border-3 border-primary" : "align-self-end $colorClass";
                
            $result[] = [
                'interaction' => $i,
                'user' => $user,
                'tipoUsuario' => $tipoUsuario,
                'isUsuario' => $isUsuario,
                'foto' => $foto,
                'colorClass' => $colorClass,
                'classes' => $classes
            ];
            }
            return $result;      
    }

}