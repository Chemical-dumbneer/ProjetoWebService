<?php
    session_start();
    //require '../control/login.control.php.';// login ainda falta mostrar ao usuario erro
    require '../control/ticket.control.php';
    require '../control/user.control.php';


    if (!isset($_SESSION['logado'])) {
        validarUsuario();
        exit;
    }
    //getTickets();


$action = $_GET['action'] ?? 'cadastrar';

if($action == 'cadastrar'){
    cadastrarUser();
    } else if($action == 'listar'){
      listarUsers();
    }elseif($action == 'newTicket'){
        getTickets();
    }
?>