<?php
use model\User;
use enum\TipoUsuario;

function getUsers():array {
    return $_SESSION["temp_usuarios"];
}

function validarCredenciais(string $login, string $senha):bool {
    $usuarios = getUsers();
    /** @var User $usuario */
    foreach ($usuarios as $usuario) {
        if ($usuario->getUsername() === $login && $usuario->getSenha() === $senha) {
            return true;
        }
    }
    return false;
}

function addUser(User $novoUsuario):void {
    $_SESSION['temp_usuarios'][]  = $novoUsuario;
}

function getUserByUsername(string $username) {
    /** @var User $u */
    foreach ($_SESSION['temp_usuarios'] as $u) {
        if ($u->getUsername() === $username) {
            return $u;
        }
    }
    return null;
}