<?php
namespace routes;
use Pecee\SimpleRouter\SimpleRouter;
use Pecee\Http\Request;
use control\UserControl;
use control\TicketControl;
// Login
SimpleRouter::get('/login', [UserControl::class, 'validarInfoLogin']);
SimpleRouter::post('/login', [UserControl::class, 'validarInfoLogin']);
SimpleRouter::get('/logout', function() {
     $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    SimpleRouter::response()->redirect('/login');
});
//User
    SimpleRouter::get('/', [TicketControl::class, 'listarTickets']);
    SimpleRouter::get('/user/listar', [UserControl::class, 'listarUsers']);

    SimpleRouter::get('/user/new', [UserControl::class, 'cadastrarUser']);
    SimpleRouter::post('/user/new', [UserControl::class, 'cadastrarUser']);

    //Ticket
    SimpleRouter::get('/home', [TicketControl::class, 'listarTickets']);

    SimpleRouter::get('/ticket/new', [TicketControl::class, 'createTicket']);
    SimpleRouter::post('/ticket/new',  [TicketControl::class, 'createTicket']);

    SimpleRouter::get('/ticket/my', [TicketControl::class, 'listarMeusTickets']);

    SimpleRouter::get('/ticket/{id}/timeline', [TicketControl::class, 'abrirTimeLine']);
    SimpleRouter::post('/ticket/{id}/timeline', [TicketControl::class, 'abrirTimeLine']);


    SimpleRouter::error(function(Request $request, \Exception $exception) {
        if($exception instanceof \Pecee\SimpleRouter\Exceptions\NotFoundHttpException) {
            http_response_code(404);
            echo '<h1>404 - Página não encontrada</h1>';
            exit;
        }
    });

?>