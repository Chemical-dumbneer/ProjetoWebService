<?php
namespace repository;
use model\User;
use enum\TipoUsuario;

class UserRepository{
     public function __construct() {
    }

    static function getUsers():array {
        return $_SESSION["temp_usuarios"];
    }

    static function validarCredenciais(string $login, string $senha):bool {
        foreach (UserRepository::getUsers() as $usuario) {
            if ($usuario->getUsername() === $login && $usuario->getSenha() === $senha) {
                return true;
            }
        }
        return false;
    }

    static function addUser(User $novoUsuario): void {
        $_SESSION['temp_usuarios'][] = $novoUsuario;
    }

    static function getUserByUsername(string $username):User | null {
        /** @var User $u */
        foreach ($_SESSION['temp_usuarios'] as $u) {
            if ($u->getUsername() === $username) {
                return $u;
            }
        }
        return null;
    }   
}