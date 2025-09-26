<?php

namespace entities;

class user
{
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuarios'])) {
            $_SESSION['usuarios'] = [];
        }
    }

    private $usuarios = [
        ["login" => "admin", "senha" => "1234"],
        ["login" => "jonas", "senha" => "abcd"],
        ["login" => "andré","senha" => "777"]
    ];

    private static $users = [];


     public function validarLogin($login, $senha) {
        foreach ($this->usuarios as $usuario) {
            if ($usuario["login"] === $login && $usuario["senha"] === $senha) {
                return true;
            }
        }
        return false;
    }

    public function addUser($nome,$cargo,$funcao,$fotoPath){

         $_SESSION['usuarios'][]  = [
            'nome' => $nome,
            'cargo' => $cargo,
            'funcao' => $funcao,
            'foto' => $fotoPath
        ];
    }
    
     public function getUsers() {
        return  $_SESSION['usuarios'];
    }

    public function getUserByUsername($username) {
        $usuarios = $_SESSION['usuarios'] ?? [];
        foreach ($usuarios as $u) {
            if ($u['nome'] === $username) {
                return $u;
            }
        }
        return null;
    }
}