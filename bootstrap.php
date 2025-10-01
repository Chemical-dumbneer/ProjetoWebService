<?php
require_once __DIR__ . '/src/model/Ticket.php';
use model\Ticket;
require_once __DIR__ . '/src/model/TicketInteraction.php';
use model\TicketInteraction;
require_once __DIR__ . '/src/enum/TicketStatus.php';
use enum\TicketStatus;
require_once __DIR__ . '/src/enum/TicketInteractionType.php';
use enum\TicketInteractionType;
require_once __DIR__ . '/src/model/User.php';
use model\User;
require_once __DIR__ . '/src/enum/TipoUsuario.php';
use enum\TipoUsuario;

// definir constantes
define('APP_ROOT', dirname(__DIR__));
define('SRC_PATH', APP_ROOT . '/src');

// iniciar sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['_seeded_tickets'])) {
    $_SESSION["temp_usuarios"] = [
        new User("admin", "Administrador", "admin", 'img/users/defaultUserPic.png', TipoUsuario::Tecnico),
        new User("jeancarlos", "Jean Pires de Carlos", "jean1234", 'img/users/defaultUserPic.png',TipoUsuario::Tecnico),
        new User("andreemilio", "Andre Luiz Pereira Emilio", "andre1234", 'img/users/defaultUserPic.png',TipoUsuario::Tecnico),
        new User("testuser", "Usuário de Teste", "test1234", 'img/users/defaultUserPic.png',TipoUsuario::Usuario)
    ];

    $_SESSION['temp_tickets'] = [
        new Ticket(
            id: 1,
            requerent: 'testuser',
            titulo: 'Erro no login',
            descricao: 'Não consigo fazer login com usuário e senha corretos.',
            dataCriacao: new DateTime('2025-09-10 08:00:00'),
            status: TicketStatus::Aberto
        ),
        new Ticket(
            id: 2,
            requerent: 'testuser',
            titulo: 'Solicitação de relatório de vendas',
            descricao: 'Preciso do relatório de vendas entre 01/09 e 30/09.',
            dataCriacao: new DateTime('2025-09-11 09:15:00'),
            status: TicketStatus::Aberto
        ),
        new Ticket(
            id: 3,
            requerent: 'testuser',
            titulo: 'Bug no formulário de cadastro',
            descricao: 'O campo “telefone” trava o botão de enviar.',
            dataCriacao: new DateTime('2025-09-12 10:30:00'),
            status: TicketStatus::Aberto
        ),
        new Ticket(
            id: 4,
            requerent: 'testuser',
            titulo: 'Sugestão de nova funcionalidade',
            descricao: 'Seria bom exportar tickets para PDF.',
            dataCriacao: new DateTime('2025-09-13 11:00:00'),
            status: TicketStatus::Aberto
        ),
        new Ticket(
            id: 5,
            requerent: 'testuser',
            titulo: 'Problema com upload de arquivos',
            descricao: 'Não consigo anexar imagens nos tickets.',
            dataCriacao: new DateTime('2025-09-14 12:45:00'),
            status: TicketStatus::Aberto
        ),
        new Ticket(
            id: 6,
            requerent: 'testuser',
            titulo: 'Erro ao salvar configurações',
            descricao: 'As alterações de perfil não são salvas.',
            dataCriacao: new DateTime('2025-09-15 14:20:00'),
            status: TicketStatus::Aberto
        ),
        new Ticket(
            id: 7,
            requerent: 'testuser',
            titulo: 'Timeout na consulta',
            descricao: 'Consulta demora muito tempo e dá erro.',
            dataCriacao: new DateTime('2025-09-16 15:55:00'),
            status: TicketStatus::Aberto
        ),
        new Ticket(
            id: 8,
            requerent: 'testuser',
            titulo: 'Mensagem de erro genérica',
            descricao: 'Quando algo falha, aparece “Erro desconhecido”.',
            dataCriacao: new DateTime('2025-09-17 16:30:00'),
            status: TicketStatus::Aberto
        ),
        new Ticket(
            id: 9,
            requerent: 'testuser',
            titulo: 'Dúvida sobre permissões',
            descricao: 'Por que usuários não podem ver tickets dos outros?',
            dataCriacao: new DateTime('2025-09-18 17:10:00'),
            status: TicketStatus::Solucionado
        ),
        new Ticket(
            id: 10,
            requerent: 'testuser',
            titulo: 'Solicitação de reset de senha',
            descricao: 'Quero redefinir minha senha via e-mail.',
            dataCriacao: new DateTime('2025-09-19 18:00:00'),
            status: TicketStatus::Solucionado
        ),
    ];

    // Interações variadas
    // Ticket 1
    $t = &$_SESSION['temp_tickets'][0];
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 1,
        author: 'andreemilio',
        datetime: new DateTime('2025-09-10 08:30:00'),
        interactionType: TicketInteractionType::Task,
        descricao: 'Você já tentou limpar cache do navegador?'
    ));
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 2,
        author: 'testuser',
        datetime: new DateTime('2025-09-10 08:35:00'),
        interactionType: TicketInteractionType::FollowUp,
        descricao: 'Sim, mas continua o mesmo erro.'
    ));
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 3,
        author: 'jeancarlos',
        datetime: new DateTime('2025-09-10 09:00:00'),
        interactionType: TicketInteractionType::FollowUp,
        descricao: 'Vou verificar logs e retorno em instantes.'
    ));

    // Ticket 2
    $t = &$_SESSION['temp_tickets'][1];
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 1,
        author: 'jeancarlos',
        datetime: new DateTime('2025-09-11 09:45:00'),
        interactionType: TicketInteractionType::Task,
        descricao: 'Você quer relatório mensal ou diário?'
    ));
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 2,
        author: 'testuser',
        datetime: new DateTime('2025-09-11 09:50:00'),
        interactionType: TicketInteractionType::FollowUp,
        descricao: 'Mensal, por favor.'
    ));

    // Ticket 3
    $t = &$_SESSION['temp_tickets'][2];
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 1,
        author: 'andreemilio',
        datetime: new DateTime('2025-09-12 11:00:00'),
        interactionType: TicketInteractionType::Task,
        descricao: 'Pode me dizer o navegador e versão?'
    ));
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 2,
        author: 'testuser',
        datetime: new DateTime('2025-09-12 11:10:00'),
        interactionType: TicketInteractionType::FollowUp,
        descricao: 'Uso Chrome versão 115.'
    ));

    // Ticket 4
    $t = &$_SESSION['temp_tickets'][3];
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 1,
        author: 'jeancarlos',
        datetime: new DateTime('2025-09-13 11:30:00'),
        interactionType: TicketInteractionType::FollowUp,
        descricao: 'Boa ideia — farei proposta ao time.'
    ));

    // Ticket 5
    $t = &$_SESSION['temp_tickets'][4];
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 1,
        author: 'andreemilio',
        datetime: new DateTime('2025-09-14 13:00:00'),
        interactionType: TicketInteractionType::Task,
        descricao: 'Que tipo de arquivo você tentou anexar?'
    ));
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 2,
        author: 'testuser',
        datetime: new DateTime('2025-09-14 13:05:00'),
        interactionType: TicketInteractionType::FollowUp,
        descricao: 'Imagem PNG de 500 KB.'
    ));

    // Ticket 6
    $t = &$_SESSION['temp_tickets'][5];
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 1,
        author: 'jeancarlos',
        datetime: new DateTime('2025-09-15 14:30:00'),
        interactionType: TicketInteractionType::Task,
        descricao: 'Está chegando algum erro?'
    ));

    // Ticket 7
    $t = &$_SESSION['temp_tickets'][6];
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 1,
        author: 'jeancarlos',
        datetime: new DateTime('2025-09-16 16:10:00'),
        interactionType: TicketInteractionType::Task,
        descricao: 'Qual é a consulta que você executou?'
    ));

    // Ticket 8
    $t = &$_SESSION['temp_tickets'][7];
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 1,
        author: 'andreemilio',
        datetime: new DateTime('2025-09-17 17:00:00'),
        interactionType: TicketInteractionType::Task,
        descricao: 'Você consegue capturar o erro e mandar?'
    ));
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 2,
        author: 'testuser',
        datetime: new DateTime('2025-09-17 17:05:00'),
        interactionType: TicketInteractionType::FollowUp,
        descricao: 'Aqui está o print do console…'
    ));

    // Ticket 9
    $t = &$_SESSION['temp_tickets'][8];
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 1,
        author: 'jeancarlos',
        datetime: new DateTime('2025-09-18 18:00:00'),
        interactionType: TicketInteractionType::FollowUp,
        descricao: 'Boa pergunta — por enquanto, apenas seu próprio ticket é visível.'
    ));

    // Ticket 10
    $t = &$_SESSION['temp_tickets'][9];
    $t->addInteraction(new TicketInteraction(
        timelinePosition: 1,
        author: 'andreemilio',
        datetime: new DateTime('2025-09-19 18:30:00'),
        interactionType: TicketInteractionType::Solution,
        descricao: 'Enviei link para resetar a senha por e-mail.'
    ));

    $_SESSION['_seeded_tickets'] = true;
    session_write_close();
}

// Autoload simples (se não usar Composer)
//spl_autoload_register(function ($class) {
   //$path = APP_ROOT . '/' . str_replace('\\', '/', $class) . '.php';
   //if (file_exists($path)) {
    //   require $path;
   //}
//});

// talvez carregar configurações
//$config = require APP_ROOT . '/config/config.php';

// inicializar serviços globais, etc.
// ex: conectar ao banco, logger, cache etc.<?php
