<?php

namespace entity;

class ticket
{
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['tickets'])) {
            $_SESSION['tickets'] = [];
        }
    }

    public function addTicket($titulo,$descricao, $usuario){

         $_SESSION['tickets'][]  = [
            'titulo' => $titulo,
            'descricao' => $descricao,
            'usuario'=>  $usuario
        ];
    }

     public function getTickets() {
        return  $_SESSION['tickets'];
    }

    public function findTicket($titulo) {
    if (!isset($_SESSION['tickets'])) {
        return null;
    }
    foreach ($_SESSION['tickets'] as $t) {
        if ($t['titulo'] === $titulo) {
            return $t;
        }
    }
    return null;
}
}